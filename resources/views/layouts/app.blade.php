<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FanIoT') · FanIoT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{font-family:Inter,ui-sans-serif,system-ui;background:#f6f9fd;color:#10213a}
        .glass{background:rgba(255,255,255,.88);backdrop-filter:blur(14px)}
        .shadow-soft{box-shadow:0 12px 36px rgba(32,73,130,.08)}
        .nav-active{background:#eaf2ff;color:#2463eb}
        .field{width:100%;border:1px solid #dbe4f0;border-radius:12px;padding:12px 14px;outline:none}
        .field:focus{border-color:#3b82f6;box-shadow:0 0 0 3px #dbeafe}
    </style>
</head>
<body>
@yield('content')
@stack('scripts')
</body>
</html>
