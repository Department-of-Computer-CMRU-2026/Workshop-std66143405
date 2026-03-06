<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <style>
            .auth-bg {
                background: linear-gradient(135deg, #2c3e50, #4ca1af);
                background-attachment: fixed;
                position: relative;
                overflow: hidden;
            }
            .auth-bg::before {
                content: "";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
                animation: rotate 20s linear infinite;
            }
            @keyframes rotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 40px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
            .navy-btn {
                background: #002d5b;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .navy-btn:hover {
                background: #003d7b;
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            }
            .input-group-side {
                background: #23395d;
                width: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .input-field {
                background: #3e5b8a;
                color: #e2e8f0;
            }
            .input-field::placeholder {
                color: rgba(255, 255, 255, 0.5);
            }
        </style>
    </head>
    <body class="min-h-screen antialiased auth-bg flex items-center justify-center p-6">
        {{ $slot }}
        @fluxScripts
    </body>
</html>
