<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحميل تطبيق تست - لتعليم القيادة</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #f1c40f;
            /* لون أصفر مروري */
            --text-color: #ffffff;
            --bg-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            width: 90%;
            padding: 20px;
            gap: 50px;
        }

        /* الجزء الأيمن: النصوص والتحميل */
        .content {
            flex: 1;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            color: var(--accent-color);
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .download-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            background: #000;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 2px solid transparent;
            transition: 0.3s;
        }

        .btn:hover {
            border-color: var(--accent-color);
            transform: translateY(-3px);
        }

        .btn-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .btn-text span {
            font-size: 0.7rem;
        }

        .btn-text strong {
            font-size: 1.1rem;
        }

        /* الجزء الأيسر: الموك آب */
        .mockup-container {
            flex: 1;
            display: flex;
            justify-content: center;
            position: relative;
        }

        .phone {
            width: 250px;
            height: 500px;
            background: #333;
            border-radius: 40px;
            border: 8px solid #444;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .screen {
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 40px;
            color: #333;
        }

        .test-card {
            width: 80%;
            height: 100px;
            background: #fff;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-right: 5px solid var(--accent-color);
        }

        /* تجاوب التصميم للشاشات الصغيرة */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                overflow-y: auto;
            }

            .download-buttons {
                justify-content: center;
            }

            .phone {
                width: 180px;
                height: 360px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- المحتوى -->
        <div class="content">
            <h1>تطبيق تست test.ps</h1>
            <p>اجتز اختبار القيادة النظري من المرة الأولى! تطبيقنا يوفر لك أحدث الأسئلة، نماذج الامتحانات، وشرح كامل
                لإشارات المرور بطريقة تفاعلية وسهلة.</p>

            <div class="download-buttons">
                <!-- رابط App Store -->
                <a href="{{ $app_store }}" class="btn">
                    <div class="btn-text">
                        <span>متوفر على</span>
                        <strong>App Store</strong>
                    </div>
                </a>

                <!-- رابط Google Play -->
                <a href="{{ $google_play }}" class="btn">
                    <div class="btn-text">
                        <span>احصل عليه من</span>
                        <strong>Google Play</strong>
                    </div>
                </a>
            </div>
        </div>

        <!-- صورة الهاتف المتخيلة -->
        <div class="mockup-container">
            <div class="phone">
                <div class="-screen">
                    {{-- <div style="font-weight: bold; margin-bottom: 20px;">اختبار تجريبي</div>
                    <div class="test-card"></div>
                    <div class="test-card"></div>
                    <div class="test-card"></div>
                    <div style="margin-top: auto; padding-bottom: 20px; font-size: 12px; color: #888;">www.test-app.com
                    </div> --}}
                    <img src="{{ asset('assets/img/app.jpeg') }}" alt="" width=250px">
                </div>
            </div>
        </div>
    </div>

</body>

</html>