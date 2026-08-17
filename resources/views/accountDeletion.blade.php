<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deletion Request - NAKAE Works</title>
    <!-- Google Fonts & Bootstrap 5 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --border-color: #334155;
            --accent-primary: #38bdf8;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }

        .deletion-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 0 !important;
            max-width: 600px;
            width: 100%;
            padding: 30px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        }

        .form-control-dark, .form-select-dark {
            background: #090d16;
            border: 1px solid #334155;
            color: #f8fafc;
            font-size: 0.9rem;
            border-radius: 0 !important;
            height: 42px;
        }

        .form-control-dark:focus, .form-select-dark:focus {
            background: #090d16;
            border-color: #38bdf8;
            color: #fff;
            box-shadow: none;
        }

        .btn-sharp-danger {
            background: #dc2626;
            color: #fff;
            border: none;
            border-radius: 0 !important;
            font-weight: 700;
            padding: 12px 24px;
            transition: all 0.2s ease;
        }

        .btn-sharp-danger:hover {
            background: #b91c1c;
            color: #fff;
        }

        .alert-sharp-success {
            background: #064e3b;
            border: 1px solid #059669;
            color: #34d399;
            border-radius: 0 !important;
            padding: 14px;
        }

        .data-info-box {
            background: #090d16;
            border-left: 4px solid #38bdf8;
            padding: 14px;
            font-size: 0.82rem;
            color: #94a3b8;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>

    <div class="deletion-card">
        <!-- BRANDING HEADER -->
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white p-3 mb-2" style="width: 50px; height: 50px;">
                <i class="mdi mdi-account-remove fs-2"></i>
            </div>
            <h4 class="fw-bold text-white mb-1">NAKAE Works - Account Deletion Request</h4>
            <p class="text-muted small mb-0">Google Play Data Safety & User Privacy Portal</p>
        </div>

        @if(session('success'))
            <div class="alert alert-sharp-success mb-4 d-flex align-items-center gap-2">
                <i class="mdi mdi-check-circle fs-4"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="data-info-box">
            <i class="mdi mdi-shield-check text-info me-1"></i>
            <strong>Data Deletion Rights Notice:</strong> Requesting account deletion will permanently remove your profile, login credentials, saved addresses, and active preferences from NAKAE Works servers within 24 to 48 hours.
        </div>

        <form action="{{ url('/account-deletion-request') }}" method="POST">
            @csrf

            <!-- ACCOUNT TYPE -->
            <div class="mb-3">
                <label class="form-label text-white small fw-bold">Select Account Type *</label>
                <select name="user_type" class="form-select form-select-dark" required>
                    <option value="customer">Customer / Service Requester</option>
                    <option value="vendor">Vendor Partner / Mistry Technician</option>
                </select>
            </div>

            <!-- PHONE OR EMAIL -->
            <div class="mb-3">
                <label class="form-label text-white small fw-bold">Registered Mobile Number or Email *</label>
                <input type="text" name="phone_or_email" class="form-control form-control-dark" placeholder="e.g. +91 9876543210 or user@example.com" required>
            </div>

            <!-- REASON FOR DELETION -->
            <div class="mb-4">
                <label class="form-label text-white small fw-bold">Reason for Deletion (Optional)</label>
                <textarea name="reason" class="form-control form-control-dark" style="height: 80px;" placeholder="Tell us why you want to delete your account..."></textarea>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sharp-danger text-uppercase">
                    <i class="mdi mdi-delete-forever me-1"></i> Submit Account Deletion Request
                </button>
            </div>
        </form>

        <div class="text-center mt-4 border-top border-secondary pt-3">
            <a href="{{ url('/') }}" class="text-muted small text-decoration-none">
                <i class="mdi mdi-arrow-left me-1"></i> Back to NAKAE Works Home
            </a>
        </div>
    </div>

</body>
</html>
