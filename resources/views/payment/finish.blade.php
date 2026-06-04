{{-- Ultra Minimalist Success Page --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhasil - Humana</title>
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
            --green: #22C55E;
            --green-light: #DCFCE7;
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
            background: linear-gradient(135deg, var(--green-light) 0%, var(--gray-100) 100%);
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
            background: var(--green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            animation: scale 0.4s ease-out;
        }

        .icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        @keyframes scale {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
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
            margin-bottom: 32px;
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
            color: var(--blue);
        }

        .notice {
            background: var(--green-light);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
        }

        .notice svg {
            width: 20px;
            height: 20px;
            fill: var(--green);
            flex-shrink: 0;
        }

        .notice p {
            font-size: 14px;
            color: #166534;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 16px;
            background: var(--blue);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            transition: all 0.2s;
        }

        .btn:hover {
            background: #2563EB;
        }

        .footer {
            margin-top: 24px;
            font-size: 14px;
            color: var(--gray-400);
        }

        .footer a {
            color: var(--blue);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <svg viewBox="0 0 24 24">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
            </svg>
        </div>

        <h1>Pembayaran Berhasil</h1>
        <p class="message">Transaksi Anda telah berhasil diproses.</p>

        <div class="notice">
            <svg viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <p>Konfirmasi pembayaran akan dikirim ke email Anda.</p>
        </div>

        <div class="order">
            <div class="order-label">Nomor Order</div>
            <div class="order-value">{{ $order_id ?? 'N/A' }}</div>
        </div>

        <a href="/" class="btn">Kembali ke Beranda</a>

        <p class="footer">Butuh bantuan? <a href="mailto:support@humana.com">Hubungi Kami</a></p>
    </div>
</body>
</html>