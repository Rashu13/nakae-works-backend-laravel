<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - NAKAE Works</title>

    <!-- Importing a modern Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --text-main: #374151;
            --text-muted: #6b7280;
            --bg-body: #f3f4f6;
            --bg-card: #ffffff;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            line-height: 1.8;
            -webkit-font-smoothing: antialiased;
        }

        /* Modern Gradient Header */
        .header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: #fff;
            padding: 60px 20px 80px;
            text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        .header h1 {
            font-size: 40px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            font-weight: 300;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Main Container & Card */
        .container {
            max-width: 900px;
            margin: -40px auto 40px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .policy-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Updated Date */
        .updated {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        /* Intro Box */
        .intro {
            font-size: 17px;
            color: #1f2937;
            background: #f8fafc;
            border-left: 4px solid var(--primary);
            padding: 20px 25px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 40px;
            font-weight: 500;
        }

        /* Typography inside sections */
        .policy-section {
            margin-bottom: 40px;
        }

        .policy-section h2 {
            font-size: 24px;
            color: #111827;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
        }

        .policy-section h3 {
            font-size: 18px;
            color: #1f2937;
            margin: 24px 0 12px;
            font-weight: 600;
        }

        .policy-section p {
            margin-bottom: 16px;
            color: var(--text-main);
        }

        /* Styled Lists */
        ul {
            list-style: none;
            padding-left: 0;
            margin: 15px 0;
        }

        li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 10px;
            color: var(--text-main);
        }

        li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 0;
            color: var(--primary);
            font-weight: bold;
            font-size: 14px;
        }

        /* Premium Contact Box */
        .contact-box {
            background: #f9fafb;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            margin-top: 20px;
            display: grid;
            gap: 12px;
        }

        .contact-box p {
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .contact-box strong {
            color: var(--primary-dark);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .footer {
            text-align: center;
            padding: 30px 20px 50px;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .header {
                padding: 40px 15px 60px;
                clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
            }

            .header h1 { font-size: 30px; }

            .container {
                margin-top: -30px;
                padding: 0 15px;
            }

            .policy-card { padding: 30px 20px; }
            .policy-section h2 { font-size: 20px; }
            .policy-section h3 { font-size: 17px; }
            .intro { font-size: 15px; padding: 15px; }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="header">
        <h1>Terms and Conditions</h1>
        <p>NAKAE Works</p>
    </header>

    <div class="container">
        <div class="policy-card">

            <div class="updated">
                Last Updated: 10 August 2026
            </div>

            <div class="intro">
                Welcome to NAKAE Works. By downloading, accessing, or using the NAKAE Works application, you agree to be bound by these Terms and Conditions. Please read them carefully before using our platform.
            </div>

            <!-- Section 1 -->
            <section class="policy-section">
                <h2>1. Acceptance of Terms</h2>
                <p>By creating an account or using the NAKAE Works app, you accept and agree to comply with these Terms and Conditions. If you do not agree with any part of these terms, you may not use our services.</p>
                <p>These terms apply to all users of the platform, including customers seeking services and professionals providing services.</p>
            </section>

            <!-- Section 2 -->
            <section class="policy-section">
                <h2>2. Description of Service</h2>
                <p>NAKAE Works is a digital marketplace that facilitates connections between users (customers) and independent service providers (such as electricians, plumbers, painters, etc.).</p>
                <ul>
                    <li>We do not employ the service providers directly.</li>
                    <li>We act solely as an intermediary to help you find and book local professionals.</li>
                    <li>We do not guarantee the quality, suitability, or safety of the services provided by independent professionals, though we strive to verify them.</li>
                </ul>
            </section>

            <!-- Section 3 -->
            <section class="policy-section">
                <h2>3. User Accounts</h2>
                <p>To use most features of NAKAE Works, you must register for an account. You agree to:</p>
                <ul>
                    <li>Provide accurate, current, and complete information during registration.</li>
                    <li>Maintain the security and confidentiality of your account credentials.</li>
                    <li>Be strictly responsible for all activities that occur under your account.</li>
                    <li>Notify us immediately if you suspect any unauthorized use of your account.</li>
                </ul>
                <p>You must be at least 18 years old to create an account on NAKAE Works.</p>
            </section>

            <!-- Section 4 -->
            <section class="policy-section">
                <h2>4. Service Provider Obligations</h2>
                <p>If you are using NAKAE Works as a Service Provider, you agree to:</p>
                <ul>
                    <li>Possess the necessary skills, qualifications, and licenses to perform the offered services.</li>
                    <li>Provide services professionally, safely, and in accordance with local laws.</li>
                    <li>Not bypass the platform to secure direct payments from users introduced via NAKAE Works.</li>
                    <li>Keep your profile, availability, and pricing accurate and up to date.</li>
                </ul>
            </section>

            <!-- Section 5 -->
            <section class="policy-section">
                <h2>5. Payments and Fees</h2>
                <p>All payments for services booked through NAKAE Works must be made as per the guidelines provided within the app.</p>
                <ul>
                    <li><strong>For Users:</strong> You agree to pay the agreed-upon amount for the services requested. Prices may vary based on the scope of work.</li>
                    <li><strong>For Providers:</strong> NAKAE Works may charge a commission or platform fee for bookings secured through the app. These fees will be communicated to you separately.</li>
                </ul>
            </section>

            <!-- Section 6 -->
            <section class="policy-section">
                <h2>6. Cancellations and Refunds</h2>
                <p>We understand that plans can change. Our cancellation policy is as follows:</p>
                <ul>
                    <li>Users may cancel a booking through the app prior to the service provider's arrival, subject to potential cancellation fees if done at the last minute.</li>
                    <li>If a service provider fails to arrive or cancels, users will not be charged, and we will attempt to find a replacement.</li>
                    <li>Refunds for unsatisfactory services are handled on a case-by-case basis and must be reported within 24 hours of service completion.</li>
                </ul>
            </section>

            <!-- Section 7 -->
            <section class="policy-section">
                <h2>7. Prohibited Activities</h2>
                <p>While using NAKAE Works, you agree not to:</p>
                <ul>
                    <li>Use the platform for any illegal or unauthorized purpose.</li>
                    <li>Harass, abuse, or harm other users or service providers.</li>
                    <li>Submit false or misleading information or create duplicate accounts.</li>
                    <li>Attempt to hack, destabilize, or adapt the application's source code.</li>
                </ul>
            </section>

            <!-- Section 8 -->
            <section class="policy-section">
                <h2>8. Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, NAKAE Works and its affiliates shall not be liable for any indirect, incidental, special, or consequential damages resulting from your use of the platform.</p>
                <p>Any disputes arising from the actual service performed must be resolved primarily between the user and the service provider, though NAKAE Works may assist in dispute resolution.</p>
            </section>

            <!-- Section 9 -->
            <section class="policy-section">
                <h2>9. Termination</h2>
                <p>We reserve the right to suspend or terminate your account and access to NAKAE Works at our sole discretion, without notice, for conduct that we believe violates these Terms and Conditions or is harmful to other users, us, or third parties.</p>
            </section>

            <!-- Section 10 -->
            <section class="policy-section">
                <h2>10. Changes to Terms</h2>
                <p>We may modify these Terms and Conditions at any time. We will notify users of significant changes by updating the "Last Updated" date at the top of this page or via an in-app notification. Continued use of the app after changes are made constitutes your acceptance of the new terms.</p>
            </section>

            <!-- Section 11 -->
            <section class="policy-section">
                <h2>11. Contact Us</h2>
                <p>If you have any questions or concerns about these Terms and Conditions, please reach out to us.</p>

                <div class="contact-box">
                    <p>
                        <strong>App Name</strong>
                        NAKAE Works Mistri
                    </p>
                    <p>
                        <strong>Developer/Company</strong>
                        NAKAE Works
                    </p>
                    <p>
                        <strong>Email</strong>
                        <a href="mailto:kinolexexpert@gmail.com" style="color: var(--primary); text-decoration: none;">kinolexexpert@gmail.com</a>
                    </p>
                    <p>
                        <strong>Address</strong>
                        <span>Bus Stand, Sabzi Mandi, Sadul Shahar,<br>Sri Ganganagar, Rajasthan - 335062</span>
                    </p>
                </div>
            </section>

        </div>
    </div>

    <footer class="footer">
        © 2026 NAKAE Works. All Rights Reserved.
    </footer>

</body>
</html>
