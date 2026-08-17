<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - NAKAE Works</title>

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
        <h1>Privacy Policy</h1>
        <p>NAKAE Works</p>
    </header>

    <div class="container">
        <div class="policy-card">

            <div class="updated">
                Last Updated: 10 August 2026
            </div>

            <div class="intro">
                NAKAE Works is a service marketplace application that connects users with service providers such as electricians, plumbers, painters, and other professionals.
            </div>

            <!-- Section 1 -->
            <section class="policy-section">
                <h2>1. Information We Collect</h2>
                <p>Depending on how you use NAKAE Works, we may collect the following information:</p>

                <h3>Personal Information</h3>
                <ul>
                    <li>Full name</li>
                    <li>Mobile phone number</li>
                    <li>Email address</li>
                    <li>Profile information & photograph</li>
                    <li>Address and Service location</li>
                </ul>

                <h3>Location Information</h3>
                <p>NAKAE Works may collect GPS-based location information when required to provide location-based services.</p>
                <ul>
                    <li>Find nearby service providers</li>
                    <li>Show relevant services in your area</li>
                    <li>Help service providers locate the requested service</li>
                    <li>Improve service matching</li>
                </ul>

                <h3>Service Provider Information</h3>
                <ul>
                    <li>Name and contact details</li>
                    <li>Profile photograph & Service category</li>
                    <li>Address/location & Verification documents</li>
                    <li>Service-related information</li>
                </ul>

                <h3>Service Requests and Booking Information</h3>
                <ul>
                    <li>Service requests and Booking details</li>
                    <li>Selected service category & Service location</li>
                    <li>Date, time of service, and Booking status</li>
                    <li>Service history</li>
                </ul>

                <h3>Chat and Communication Information</h3>
                <p>If you use the chat or communication features of NAKAE Works, we may process information contained in those communications to provide the requested service, maintain bookings, resolve disputes, and maintain platform safety.</p>
            </section>

            <!-- Section 2 -->
            <section class="policy-section">
                <h2>2. How We Use Your Information</h2>
                <p>We may use collected information to:</p>
                <ul>
                    <li>Create and manage your NAKAE Works account</li>
                    <li>Connect users with suitable service providers</li>
                    <li>Process service requests and bookings</li>
                    <li>Show nearby service providers</li>
                    <li>Share necessary information with the relevant service provider</li>
                    <li>Allow users and providers to communicate</li>
                    <li>Verify service-provider profiles</li>
                    <li>Provide customer support</li>
                    <li>Improve NAKAE Works services</li>
                    <li>Prevent fraud, misuse, and maintain application security</li>
                    <li>Comply with applicable laws</li>
                </ul>
            </section>

            <!-- Section 3 -->
            <section class="policy-section">
                <h2>3. Sharing of Information</h2>
                <p>NAKAE Works does not sell your personal information as a product. We may share information with service providers when necessary to provide the service requested by you. This may include:</p>
                <ul>
                    <li>Your name and Contact information</li>
                    <li>Service location/address</li>
                    <li>Requested service and Booking details</li>
                    <li>Relevant service-request information</li>
                </ul>
                <p>Information may also be disclosed when reasonably necessary to comply with applicable laws, legal processes, government requests, security requirements, fraud prevention or to protect the rights and safety of NAKAE Works and its users.</p>
            </section>

            <!-- Section 4 -->
            <section class="policy-section">
                <h2>4. Service Provider Documents</h2>
                <p>Service providers may be required to submit documents or information for verification purposes. These documents may be used for:</p>
                <ul>
                    <li>Identity and Service-provider verification</li>
                    <li>Preventing fraudulent accounts</li>
                    <li>Maintaining platform safety</li>
                </ul>
                <p>We take reasonable measures to protect submitted documents and restrict access to authorized personnel or systems where appropriate.</p>
            </section>

            <!-- Section 5 -->
            <section class="policy-section">
                <h2>5. Location Permission</h2>
                <p>NAKAE Works may request access to your device's location. Location information may be used to provide features such as nearby service-provider discovery and service-location matching.</p>
                <p>You can enable or disable location access through your device settings. Some NAKAE Works features may not function properly if location access is disabled.</p>
            </section>

            <!-- Section 6 -->
            <section class="policy-section">
                <h2>6. Data Security</h2>
                <p>We take reasonable technical and organizational measures to protect personal information against unauthorized access, alteration, disclosure, loss, or misuse.</p>
                <p>However, no electronic transmission or storage system can be guaranteed to be completely secure.</p>
            </section>

            <!-- Section 7 -->
            <section class="policy-section">
                <h2>7. Data Retention</h2>
                <p>We retain personal information only for as long as reasonably necessary to:</p>
                <ul>
                    <li>Provide NAKAE Works services</li>
                    <li>Maintain account and booking records</li>
                    <li>Resolve disputes and Prevent fraud</li>
                    <li>Meet legal obligations</li>
                </ul>
                <p>When information is no longer required, we may delete, anonymize, or securely dispose of it, subject to applicable law.</p>
            </section>

            <!-- Section 8 -->
            <section class="policy-section">
                <h2>8. Your Privacy Rights</h2>
                <p>Depending on applicable law, you may have the right to:</p>
                <ul>
                    <li>Request access to your personal information</li>
                    <li>Request correction of inaccurate information</li>
                    <li>Request deletion of your information</li>
                    <li>Withdraw certain permissions</li>
                    <li>Ask how your information is processed</li>
                    <li>Raise a privacy-related complaint</li>
                </ul>
            </section>

            <!-- Section 9 -->
            <section class="policy-section">
                <h2>9. Account and Data Deletion</h2>
                <p>If you want to delete your NAKAE Works account or request deletion of your personal information, you may contact us using the contact details provided below.</p>
                <p>We will process valid deletion requests in accordance with applicable laws and our data-retention requirements.</p>
            </section>

            <!-- Section 10 -->
            <section class="policy-section">
                <h2>10. Children's Privacy</h2>
                <p>NAKAE Works is not intended for children who are not legally permitted to use the services under applicable law.</p>
                <p>We do not knowingly collect personal information from children in violation of applicable legal requirements.</p>
            </section>

            <!-- Section 11 -->
            <section class="policy-section">
                <h2>11. Third-Party Services</h2>
                <p>NAKAE Works may use third-party services, infrastructure providers, communication services, analytics services, payment services, or other technology providers to operate and improve the application.</p>
                <p>Such providers may process information on our behalf when necessary to provide their services and may have their own privacy policies.</p>
            </section>

            <!-- Section 12 -->
            <section class="policy-section">
                <h2>12. Changes to This Privacy Policy</h2>
                <p>We may update this Privacy Policy from time to time to reflect changes in our application, services, legal requirements, or privacy practices.</p>
                <p>When changes are made, we may update the "Last Updated" date displayed at the top of this Privacy Policy.</p>
            </section>

            <!-- Section 13 -->
            <section class="policy-section">
                <h2>13. Contact Us</h2>
                <p>If you have questions, concerns, requests, or complaints regarding this Privacy Policy, please contact us.</p>

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

            <!-- Final -->
            <section class="policy-section" style="margin-bottom: 0;">
                <p style="font-size: 14px; color: var(--text-muted); text-align: center; margin-top: 30px;">
                    <em>By using NAKAE Works, you acknowledge that you have read and understood this Privacy Policy and agree to the collection and use of information as described above, subject to applicable law.</em>
                </p>
            </section>

        </div>
    </div>

    <footer class="footer">
        © 2026 NAKAE Works. All Rights Reserved.
    </footer>

</body>
</html>
