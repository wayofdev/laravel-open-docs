<!DOCTYPE html>
<html lang="en">
<head>
    <title>ReDoc</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<redoc spec-url='<?php echo $documentationFile; ?>'></redoc>
<script src="https://cdn.jsdelivr.net/npm/redoc@v<?php echo $redocVersion; ?>/bundles/redoc.standalone.js"></script>
</body>
</html>
