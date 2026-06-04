{{-- Ultra Minimalist Payment Page --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran - Humana</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --blue: #3B82F6;
            --blue-dark: #2563EB;
            --blue-light: #60A5FA;
            --blue-50: #EFF6FF;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #E5E5E5;
            --gray-300: #D4D4D4;
            --gray-400: #A3A3A3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;
            --green: #22C55E;
            --red: #EF4444;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.6;
            min-height: 100vh;
            padding: 80px 24px 48px;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 440px;
            margin: 0 auto;
        }

        /* Back Link */
        .back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-500);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 32px;
            transition: color 0.2s;
        }

        .back:hover {
            color: var(--blue);
        }

        .back svg {
            width: 18px;
            height: 18px;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 15px;
            color: var(--gray-500);
        }

        /* Amount */
        .amount {
            background: var(--blue);
            color: white;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            margin-bottom: 32px;
        }

        .amount-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-bottom: 4px;
        }

        .amount-value {
            font-size: 32px;
            font-weight: 600;
        }

        /* Form */
        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.2s;
            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px var(--blue-50);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--gray-400);
        }

        .form-group textarea {
            resize: none;
            min-height: 80px;
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 16px;
            background: var(--blue);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover:not(:disabled) {
            background: var(--blue-dark);
        }

        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn.loading {
            color: transparent;
            position: relative;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Alert */
        .alert {
            padding: 16px;
            border-radius: 12px;
            font-size: 14px;
            display: none;
        }

        .alert.error {
            background: #FEF2F2;
            color: var(--red);
            border: 1px solid #FECACA;
        }

        .alert.success {
            background: #F0FDF4;
            color: var(--green);
            border: 1px solid #BBF7D0;
        }

        /* Secure */
        .secure {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-100);
            color: var(--gray-400);
            font-size: 13px;
        }

        .secure svg {
            width: 16px;
            height: 16px;
            fill: var(--green);
        }

        /* Methods */
        .methods {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }

        .methods span {
            padding: 8px 12px;
            background: var(--gray-100);
            border-radius: 8px;
            font-size: 12px;
            color: var(--gray-500);
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="card">
            <div id="alert-error" class="alert error"></div>
            <div id="alert-success" class="alert success"></div>

            <div class="header">
                <h1>Pembayaran Sewa</h1>
                <p>Lengkapi data untuk melanjutkan</p>
            </div>

            <form id="payment-form">
                @csrf

                <div class="amount">
                    <div class="amount-label">Jumlah</div>
                    <div class="amount-value">Rp <span id="amount-display">0</span></div>
                </div>

                <div class="form">
                    <div class="form-group">
                        <label for="customer_name">Nama</label>
                        <input type="text" id="customer_name" name="customer_name" placeholder="Nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_email">Email</label>
                        <input type="email" id="customer_email" name="customer_email" placeholder="email@domain.com" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Telepon</label>
                        <input type="tel" id="customer_phone" name="customer_phone" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="form-group">
                        <label for="amount">Jumlah (Rp)</label>
                        <input type="number" id="amount" name="amount" placeholder="100000" min="10000" step="1" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Catatan</label>
                        <textarea id="description" name="description" placeholder="Contoh: Sewa Apartemen Tower A"></textarea>
                    </div>

                    <button type="submit" id="pay-button" class="btn">
                        Bayar Sekarang
                    </button>
                </div>
            </form>

            <div class="secure">
                <svg viewBox="0 0 24 24">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                </svg>
                Aman dengan Midtrans
            </div>

            <div class="methods">
                <span>Bank Transfer</span>
                <span>E-Wallet</span>
                <span>Credit Card</span>
            </div>
        </div>
    </div>

    <script>
        const amountInput = document.getElementById('amount');
        const amountDisplay = document.getElementById('amount-display');

        amountInput.addEventListener('input', function() {
            const amount = this.value || 0;
            amountDisplay.textContent = parseInt(amount).toLocaleString('id-ID');
        });

        document.getElementById('payment-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const btn = document.getElementById('pay-button');
            const alertError = document.getElementById('alert-error');
            alertError.style.display = 'none';

            const amount = parseInt(document.getElementById('amount').value);
            if (amount < 10000) {
                alertError.textContent = 'Minimum pembayaran Rp 10.000';
                alertError.style.display = 'block';
                return;
            }

            btn.disabled = true;
            btn.classList.add('loading');
            btn.textContent = 'Memproses...';

            try {
                const response = await fetch('/payment/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        customer_name: document.getElementById('customer_name').value,
                        customer_email: document.getElementById('customer_email').value,
                        customer_phone: document.getElementById('customer_phone').value,
                        amount: amount,
                        description: document.getElementById('description').value,
                    }),
                });

                const data = await response.json();

                if (data.success && data.token) {
                    window.snap.pay(data.token, {
                        onSuccess: function(result) {
                            window.location.href = '/payment/finish?order_id=' + result.order_id + '&status=success';
                        },
                        onPending: function(result) {
                            window.location.href = '/payment/unfinish?order_id=' + result.order_id;
                        },
                        onError: function(result) {
                            window.location.href = '/payment/error?order_id=' + (result.order_id || '') + '&status=error';
                        },
                        onClose: function() {
                            btn.disabled = false;
                            btn.classList.remove('loading');
                            btn.textContent = 'Bayar Sekarang';
                        }
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                alertError.textContent = error.message || 'Terjadi kesalahan. Silakan coba lagi.';
                alertError.style.display = 'block';
                btn.disabled = false;
                btn.classList.remove('loading');
                btn.textContent = 'Bayar Sekarang';
            }
        });
    </script>
</body>
</html>