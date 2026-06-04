# Turnstile Global Kit

Reusable Cloudflare Turnstile setup you can copy into any app.

## 1) Required Cloudflare values

Create a Turnstile widget in Cloudflare and collect:

- `SITE KEY` (public, frontend)
- `SECRET KEY` (private, backend)

## 2) Environment variables

Use the same naming in all projects:

- Frontend public key:
  - `NEXT_PUBLIC_TURNSTILE_SITE_KEY` (Next.js)
  - or `VITE_TURNSTILE_SITE_KEY` (Vite)
  - or `REACT_APP_TURNSTILE_SITE_KEY` (CRA)
- Backend:
  - `TURNSTILE_SECRET_KEY`
  - `TURNSTILE_VERIFY_URL=https://challenges.cloudflare.com/turnstile/v0/siteverify`

## 3) Frontend usage

1. Include Turnstile script.
2. Render widget with your site key.
3. Read token from `cf-turnstile-response`.
4. Send token to backend as `captcha_token`.
5. On failed API response, call `turnstile.reset()`.

See `frontend/turnstile-form-example.html` and `frontend/submit-handler.js`.

## 4) Backend usage (Laravel/PHP)

1. Add the helper from `backend/laravel-turnstile-verifier.php`.
2. In protected endpoints, verify `captcha_token` before business logic.
3. If verification fails, return `400` validation error.

## 5) Security notes

- Never trust frontend-only checks.
- Never expose `TURNSTILE_SECRET_KEY` to client code.
- Token is short-lived and should be verified immediately.
- Pair with API rate limiting for better bot resistance.
