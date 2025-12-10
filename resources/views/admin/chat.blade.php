@extends('layouts.admin')

@section('title', 'إدارة الرسائل')
@section('page-title', 'إدارة الرسائل')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
        height: 85vh;
    }

    .row {
        display: flex;
        height: 100%;
    }

    .col-md-8 {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #f8fafc;
        height: 100%;
    }

    #messages {
        flex: 1;
        padding: 20px 30px;
        padding-bottom: 20px;
        overflow-y: auto;
        background: #f1f5f9;
        max-height: calc(85vh - 200px);
    }

    #send-message {
        padding: 20px 30px;
        background: white;
        border-top: 1px solid #e2e8f0;
        display: flex;
        gap: 15px;
        align-items: center;
        flex-shrink: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        background: #fafafa;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
        height: 80vh;
    }

    .row {
        display: flex;
        height: 100%;
    }

    /* Users Panel */
    .col-md-4 {
        width: 350px;
        background: #016330;

        color: white;
        display: flex;
        flex-direction: column;
    }

    .col-md-4>h3 {
        padding: 25px 20px;
        background: rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    #users {
        flex: 1;
        overflow-y: auto;
        padding: 10px 0;
        list-style: none;
    }

    #contacts {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .list-group-item {
        display: flex !important;
        align-items: center !important;
        padding: 15px 20px !important;
        cursor: pointer !important;
        transition: all 0.3s ease;
        border: none !important;
        background: transparent !important;
        color: white !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        position: relative;
    }

    .list-group-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(-5px);
    }

    .list-group-item.active {
        background: rgba(255, 255, 255, 0.15) !important;
        border-right: 4px solid #10b981 !important;
        border-radius: 0px;
    }

    .list-group-item::before {
        content: attr(data-user-id) !important;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(45deg, #10b981, #06d6a0) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-left: 15px;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Chat Panel */
    .col-md-8 {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #f8fafc;
    }

    .col-md-8>h3 {
        padding: 25px 30px;
        background: white;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        color: #1e293b;
        font-size: 1.4rem;
        font-weight: 600;
        margin: 0;
    }

    #messages {
        flex: 1;
        padding: 20px 30px;
        overflow-y: auto;
        background: #f1f5f9;
    }

    /* تنسيق الرسائل */
    #messages p {
        margin: 15px 0;
        padding: 12px 18px;
        border-radius: 20px;
        font-size: 0.95rem;
        line-height: 1.4;
        max-width: 70%;
        word-wrap: break-word;
        animation: slideIn 0.3s ease;
        position: relative;
        clear: both;
    }

    /* رسائل مرسلة (من المستخدم الحالي) */
    #messages p.sent {
        background: #016330;

        color: white;
        float: right;
        margin-left: auto;
        margin-right: 0;
        border-bottom-right-radius: 5px;
        box-shadow: 0 2px 8px #016330;

    }

    /* رسائل مستقبلة (من الشخص الآخر) */
    #messages p.received {
        background: white;
        color: #334155;
        float: left;
        margin-right: auto;
        margin-left: 0;
        border-bottom-left-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* رسائل افتراضية (للتوافق مع الكود القديم) */
    #messages p:not(.sent):not(.received) {
        background: white;
        color: #334155;
        float: left;
        margin-right: auto;
        margin-left: 0;
        border-bottom-left-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Form Styling */
    #send-message {
        padding: 20px 30px;
        background: white;
        border-top: 1px solid #e2e8f0;
        display: flex;
        gap: 15px;
        align-items: center;
        position: absolute;
        bottom: 0px;
        width: 67%;
    }

    .form-control {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 25px;
        font-size: 1rem;
        outline: none;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control:focus {
        border-color: #4f46e5;
        background: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn {
        padding: 15px 25px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 1rem;
    }

    .btn-primary {
        background: #016330;
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .mt-2 {
        margin-top: 0 !important;
    }

    /* Custom Scrollbar */
    #users::-webkit-scrollbar,
    #messages::-webkit-scrollbar {
        width: 6px;
    }

    #users::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    #users::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    #messages::-webkit-scrollbar-track {
        background: #e2e8f0;
    }

    #messages::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            height: 90vh;
            margin: 10px;
            border-radius: 15px;
        }

        .col-md-4 {
            width: 280px;
        }

        #messages p {
            max-width: 85%;
        }
    }

    /* Online indicator simulation */
    .list-group-item:nth-child(odd)::after {
        content: '';
        width: 12px;
        height: 12px;
        background: #10b981;
        border-radius: 50%;
        position: absolute;
        top: 15px;
        right: 15px;
        border: 2px solid white;
        animation: pulse 2s infinite;
    }



    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }
</style>

@section( 'content')

<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>
                        @if(Auth::user()->role === 'مدير')
                        جميع المستخدمين
                        @else
                        المديرين
                        @endif
                    </h3>
                    <ul id="users" class="list-group">
                        <ul id="contacts" class="list-group">
                            @if(Auth::user()->role === 'مدير' && isset($users))
                            @foreach($users as $user)
                            <li class="list-group-item" data-user-id="{{ $user->id }}">{{ $user->name }}</li>
                            @endforeach
                            @else
                            @foreach($contacts as $contact)
                            <li class="list-group-item" data-user-id="{{ $contact->id }}">{{ $contact->name }}</li>
                            @endforeach
                            @endif
                        </ul>
                    </ul>
                </div>
                <div class="col-md-8">
                    <h3>الرسائل</h3>
                    <div id="messages"></div>
                    <form id="send-message">
                        <input type="hidden" id="to_user_id">
                        <input type="text" id="message-input" class="form-control" placeholder="إرسال رسالة">
                        <button type="submit" class="btn btn-primary mt-2">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelectorAll('#users li').forEach(user => {
                user.addEventListener('click', function() {
                // إضافة active class للتصميم
                document.querySelectorAll('#users li').forEach(u => u.classList.remove('active'));
                this.classList.add('active');

                currentUserId = this.getAttribute('data-user-id');
                document.getElementById('to_user_id').value = currentUserId;
                loadMessages(currentUserId);
                });
                });

        let currentUserId = null;

        // تحميل الرسائل عند اختيار مستخدم
        document.querySelectorAll('#users li').forEach(user => {
            user.addEventListener('click', function() {
                currentUserId = this.getAttribute('data-user-id');
                document.getElementById('to_user_id').value = currentUserId;
                loadMessages(currentUserId);
            });
        });

function loadMessages(userId) {
fetch(`/messages/${userId}`)
.then(response => response.json())
.then(messages => {
let messagesDiv = document.getElementById('messages');
messagesDiv.innerHTML = '';
messages.forEach(message => {
let p = document.createElement('p');

// تحديد إذا كانت الرسالة مرسلة أم مستقبلة
const currentUserId = {{ Auth::id() }}; // معرف المستخدم الحالي

if (message.from_user_id == currentUserId) {
// رسالة مرسلة من المستخدم الحالي - تظهر على اليمين
p.classList.add('sent');
p.textContent = message.message;
} else {
// رسالة مستقبلة - تظهر على الشمال
p.classList.add('received');
p.textContent = message.message;
}

messagesDiv.appendChild(p);
});
messagesDiv.scrollTop = messagesDiv.scrollHeight;
});
}


        // إرسال رسالة
        document.getElementById('send-message').addEventListener('submit', function(e) {
            e.preventDefault();
            let toUserId = document.getElementById('to_user_id').value;
            let messageInput = document.getElementById('message-input');
            let message = messageInput.value;

            if (!toUserId || !message) return;

            fetch('/send-message', {
                    method: 'POST'
                    , headers: {
                        'Content-Type': 'application/json'
                        , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                    , body: JSON.stringify({
                        to_user_id: toUserId
                        , message: message
                    })
                }).then(response => response.json())
                .then(data => {
                    messageInput.value = '';
                    loadMessages(toUserId);
                });
        });

        // استقبال الرسائل في الوقت الفعلي
        window.Echo.private(`chat.{{ Auth::id() }}`)
            .listen('MessageSent', (e) => {
                if (currentUserId == e.message.from_user_id || currentUserId == e.message.to_user_id) {
                    let p = document.createElement('p');
                    p.textContent = `${e.user.name} to ${e.message.receiver.name}: ${e.message.message}`;
                    document.getElementById('messages').appendChild(p);
                    document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;
                }
            });

    </script>
</body>

</html>


@endsection