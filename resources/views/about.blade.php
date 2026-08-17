<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NAKAE Works</title>

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

        /* Highlight Tag */
        .updated {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
        <h1>About Us</h1>
        <p>NAKAE Works</p>
    </header>

    <div class="container">
        <div class="policy-card">

            <div class="updated">
                Welcome to NAKAE Works
            </div>

            <div class="intro">
                NAKAE Works is your trusted local service marketplace, designed to bridge the gap between skilled professionals and customers in need of reliable home and commercial services.
            </div>

            <!-- Section 1 -->
            <section class="policy-section">
                <h2>1. Who We Are</h2>
                <p>Based in the heart of Rajasthan, NAKAE Works was founded with a simple goal: to make finding local service professionals easy, safe, and transparent. We operate primarily as a digital bridge, connecting you with verified electricians, plumbers, painters, carpenters, and other essential service providers in your area.</p>
                <p>Whether you need a quick home repair, a major installation, or routine maintenance, our platform is built to help you find the right "Mistri" (expert) for the job in just a few taps.</p>
            </section>

            <!-- Section 2 -->
            <section class="policy-section">
                <h2>2. Our Mission</h2>
                <p>At NAKAE Works, we are driven by a two-fold mission:</p>
                <ul>
                    <li><strong>For Customers:</strong> To eliminate the hassle of finding reliable help by providing a curated platform of trusted local experts, ensuring quality, safety, and fair pricing.</li>
                    <li><strong>For Professionals:</strong> To empower skilled workers and local artisans by giving them a digital platform to showcase their expertise, find consistent work, and grow their income securely.</li>
                </ul>
            </section>

            <!-- Section 3 -->
            <section class="policy-section">
                <h2>3. What We Do</h2>
                <p>We provide a seamless application experience that allows users to:</p>
                <ul>
                    <li>Browse a wide variety of service categories.</li>
                    <li>View profiles, ratings, and past work of local service providers.</li>
                    <li>Book appointments at convenient dates and times.</li>
                    <li>Communicate directly with professionals through our secure in-app features.</li>
                </ul>
            </section>

            <!-- Section 4 -->
            <section class="policy-section">
                <h2>4. Why Choose NAKAE Works?</h2>
                <p>We understand that inviting a service provider into your home or business requires trust. Here is why thousands choose NAKAE Works:</p>
                <ul>
                    <li><strong>Verified Professionals:</strong> We perform basic background and document checks to ensure you are connected with legitimate and skilled workers.</li>
                    <li><strong>Local Focus:</strong> We understand the unique needs of our community in Sri Ganganagar and surrounding areas.</li>
                    <li><strong>Ease of Use:</strong> A simple, intuitive app design means anyone can book a service without technical difficulties.</li>
                    <li><strong>Transparent Process:</strong> No hidden fees or confusing booking steps. You know exactly who is coming and what to expect.</li>
                </ul>
            </section>

            <!-- Section 5 -->
            <section class="policy-section">
                <h2>5. Get in Touch</h2>
                <p>We are always here to listen. Whether you are a customer needing assistance with a booking or a professional looking to join our platform, feel free to reach out to our support team.</p>

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
