(function () {
    let currentStep = 1;
    const totalSteps = 3;
    let professionalRowCount = 1;
    const MAX_FILE_BYTES = 4 * 1024 * 1024;
    const FILE_FIELD_IDS = ['passport_photo', 'national_id_photo', 'personal_photo', 'educational_qualification_photo', 'retirement_card_photo'];

    const form = document.getElementById('membershipWizardForm');
    const prevBtn = document.getElementById('wizardPrevBtn');
    const nextBtn = document.getElementById('wizardNextBtn');
    const submitBtn = document.getElementById('wizardSubmitBtn');
    const stepsNav = document.getElementById('membershipStepsNav');

    function showStep(step) {
        currentStep = step;
        document.querySelectorAll('[data-step-panel]').forEach(function (panel) {
            const n = parseInt(panel.getAttribute('data-step-panel'), 10);
            panel.classList.toggle('d-none', n !== step);
        });
        if (stepsNav) {
            stepsNav.querySelectorAll('li').forEach(function (li) {
                li.classList.toggle('active', parseInt(li.getAttribute('data-step'), 10) === step);
            });
        }
        if (prevBtn) prevBtn.style.display = step > 1 ? 'inline-block' : 'none';
        if (nextBtn) nextBtn.style.display = step < totalSteps ? 'inline-block' : 'none';
        if (submitBtn) submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep(step) {
        const panel = document.querySelector('[data-step-panel="' + step + '"]');
        if (!panel || !form) return true;
        const fields = panel.querySelectorAll('input, select, textarea');
        for (let i = 0; i < fields.length; i++) {
            const field = fields[i];
            if (field.type === 'file' && step < 3) continue;
            if (!field.checkValidity()) {
                field.reportValidity();
                return false;
            }
        }
        return true;
    }

    function formatFileSize(bytes) {
        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
    }

    function validateFileSize(input) {
        const file = input.files[0];
        if (!file) return true;
        if (file.size <= MAX_FILE_BYTES) return true;

        const label = input.closest('div')?.querySelector('label')?.textContent?.trim() || 'الملف';
        Swal.fire({
            icon: 'error',
            title: 'حجم الملف كبير جداً',
            text: label + ' حجمه ' + formatFileSize(file.size) + '. الحد الأقصى 4 ميجابايت لكل ملف.',
        });
        input.value = '';
        const preview = document.getElementById('preview_' + input.id);
        if (preview) {
            preview.src = '#';
            preview.style.display = 'none';
        }
        return false;
    }

    function validateAllFiles() {
        for (let i = 0; i < FILE_FIELD_IDS.length; i++) {
            const input = document.getElementById(FILE_FIELD_IDS[i]);
            if (input && !validateFileSize(input)) {
                return false;
            }
        }
        return true;
    }

    function setSubmitting(isSubmitting) {
        const overlay = document.getElementById('membershipSubmitOverlay');
        if (overlay) overlay.style.display = isSubmitting ? 'flex' : 'none';
        [prevBtn, nextBtn, submitBtn].forEach(function (btn) {
            if (btn) btn.disabled = isSubmitting;
        });
    }

    nextBtn?.addEventListener('click', function () {
        if (!validateStep(currentStep)) return;
        if (currentStep < totalSteps) showStep(currentStep + 1);
    });

    prevBtn?.addEventListener('click', function () {
        if (currentStep > 1) showStep(currentStep - 1);
    });

    // Remove Turnstile widget before submit to prevent captcha blocking
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.cf-turnstile').forEach(function (el) { el.remove(); });
        var ti = document.getElementById('captcha_token');
        if (ti) ti.remove();
    });

    form?.addEventListener('submit', function (e) {
        document.querySelectorAll('.cf-turnstile').forEach(function (el) { el.remove(); });
        if (!validateStep(3)) {
            e.preventDefault();
            return;
        }
        if (!validateAllFiles()) {
            e.preventDefault();
            return;
        }
        setSubmitting(true);
    });

    const contractType = document.getElementById('contract_type');
    const earlyReason = document.getElementById('early_reason_container');
    contractType?.addEventListener('change', function () {
        if (earlyReason) earlyReason.style.display = this.value === 'مبكر' ? 'block' : 'none';
    });

    window.addNewProfessionalRow = function () {
        const tbody = document.getElementById('professionalTableBody');
        if (!tbody) return;
        const row = document.createElement('tr');
        row.innerHTML =
            '<td><input type="text" name="professional_experience[' + professionalRowCount + '][year]" class="form-control"></td>' +
            '<td><input type="text" name="professional_experience[' + professionalRowCount + '][job_title]" class="form-control"></td>' +
            '<td><input type="text" name="professional_experience[' + professionalRowCount + '][employer]" class="form-control"></td>' +
            '<td><input type="text" name="professional_experience[' + professionalRowCount + '][years_of_experience]" class="form-control"></td>' +
            '<td><button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteProfessionalRow(this)">×</button></td>';
        tbody.appendChild(row);
        professionalRowCount++;
    };

    window.deleteProfessionalRow = function (btn) {
        const tbody = document.getElementById('professionalTableBody');
        if (tbody && tbody.children.length > 1) btn.closest('tr').remove();
    };

    ['passport_photo', 'national_id_photo', 'personal_photo', 'educational_qualification_photo', 'retirement_card_photo'].forEach(function (id) {
        const input = document.getElementById(id);
        const preview = document.getElementById('preview_' + id);
        input?.addEventListener('change', function () {
            if (!validateFileSize(input)) return;
            const file = input.files[0];
            if (!file || !preview) return;
            if (file.size > 1024 * 1024 || !file.type.startsWith('image/')) {
                preview.style.display = 'none';
                return;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    });

    const btnNew = document.getElementById('btnNewMembership');
    const btnRenew = document.getElementById('btnRenewalMembership');
    const wizard = document.getElementById('newMembershipWizard');
    const renewalModal = document.getElementById('renewalModal');

    btnNew?.addEventListener('click', function () {
        btnNew.classList.add('active');
        btnRenew?.classList.remove('active');
        if (wizard) wizard.style.display = 'block';
        if (renewalModal) renewalModal.style.display = 'none';
    });

    btnRenew?.addEventListener('click', function () {
        btnRenew.classList.add('active');
        btnNew?.classList.remove('active');
        if (wizard) wizard.style.display = 'none';
        if (renewalModal) renewalModal.style.display = 'flex';
    });

    document.getElementById('closeRenewalModal')?.addEventListener('click', function () {
        if (renewalModal) renewalModal.style.display = 'none';
        btnNew?.click();
    });

    const renewalForm = document.getElementById('renewalForm');
    renewalForm?.addEventListener('submit', function (e) {
        e.preventDefault();
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        fetch(renewalForm.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf || '', 'Accept': 'application/json' },
            body: new FormData(renewalForm),
        })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.message) Swal.fire({ icon: 'success', title: data.message });
                else if (data.error) Swal.fire({ icon: 'error', title: data.error });
            })
            .catch(function () {
                Swal.fire({ icon: 'error', title: 'حدث خطأ. حاول مرة أخرى.' });
            });
    });

    showStep(window.membershipWizardInitialStep || 1);
})();
