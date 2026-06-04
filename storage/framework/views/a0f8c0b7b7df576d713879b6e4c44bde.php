
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gagal - Humana</title>
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
            --red: #EF4444;
            --red-light: #FEE2E2;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #E5E5E5;
            --gray-400: #A3A3A3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-900: #171717;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--red-light) 0%, var(--gray-100) 100%);
            color: var(--gray-900);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .icon {
            width: 80px;
            height: 80px;
            background: var(--red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            animation: shake 0.5s ease-in-out;
        }

        .icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .message {
            font-size: 16px;
            color: var(--gray-500);
            margin-bottom: 32px;
        }

        .order {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .order-label {
            font-size: 12px;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .order-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--red);
        }

        .contact {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 32px;
            text-align: left;
        }

        .contact h3 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .contact p {
            font-size: 14px;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .contact a {
            color: var(--blue);
            text-decoration: none;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--blue);
            color: white;
        }

        .btn-primary:hover {
            background: #2563EB;
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-secondary:hover {
            border-color: var(--gray-300);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <svg viewBox="0 0 24 24">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
            </svg>
        </div>

        <h1>Pembayaran Gagal</h1>
        <p class="message">Terjadi kesalahan. Silakan coba lagi.</p>

        <div class="order">
            <div class="order-label">Nomor Order</div>
            <div class="order-value"><?php echo e($order_id ?? 'N/A'); ?></div>
        </div>

        <div class="contact">
            <h3>Butuh Bantuan?</h3>
            <p>📧 <a href="mailto:support@humana.com">support@humana.com</a></p>
            <p>📞 <a href="tel:+622112345678">+62 21 1234 5678</a></p>
        </div>

        <div class="btn-group">
            <a href="/payment" class="btn btn-primary">Coba Lagi</a>
            <a href="/" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html><?php /**PATH /Users/azis/midtrans-humana/resources/views/payment/error.blade.php ENDPATH**/ ?>