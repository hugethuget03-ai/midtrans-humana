
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belum Selesai - Humana</title>
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
            --yellow: #F59E0B;
            --yellow-light: #FEF3C7;
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
            background: linear-gradient(135deg, var(--yellow-light) 0%, var(--gray-100) 100%);
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
            background: var(--yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            animation: pulse 2s ease-in-out infinite;
        }

        .icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
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
            color: var(--yellow);
        }

        .warning {
            background: var(--yellow-light);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
        }

        .warning svg {
            width: 20px;
            height: 20px;
            fill: var(--yellow);
            flex-shrink: 0;
        }

        .warning p {
            font-size: 14px;
            color: #92400E;
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

        .footer {
            margin-top: 24px;
            font-size: 14px;
            color: var(--gray-400);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <svg viewBox="0 0 24 24">
                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h1>Belum Selesai</h1>
        <p class="message">Silakan selesaikan pembayaran Anda.</p>

        <div class="order">
            <div class="order-label">Nomor Order</div>
            <div class="order-value"><?php echo e($order_id ?? 'N/A'); ?></div>
        </div>

        <div class="warning">
            <svg viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            <p>Pembayaran akan hangus dalam 24 jam.</p>
        </div>

        <div class="btn-group">
            <a href="/payment" class="btn btn-primary">Coba Lagi</a>
            <a href="/" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>

        <p class="footer">Hubungi customer service untuk bantuan.</p>
    </div>
</body>
</html><?php /**PATH /Users/azis/midtrans-humana/resources/views/payment/unfinish.blade.php ENDPATH**/ ?>