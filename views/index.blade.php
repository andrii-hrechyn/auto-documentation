<!DOCTYPE html>
<html>
<head>
    <title>AutoDocumentation</title>
    <!-- needed for adaptive design -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Roboto:300,400,700" rel="stylesheet">

    <!--
Redoc doesn't change outer page styles
    -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="redoc-container"></div>
<script src="https://cdn.jsdelivr.net/npm/redoc@latest/bundles/redoc.standalone.js"></script>
<script>
  Redoc.init('{{ route('auto-documentation.specification') }}', {
    scrollYOffset: 50,
    hideDownloadButton: true,
    jsonSampleExpandLevel: 3,
    pathInMiddlePanel: true,
    requiredPropsFirst: true,
    theme: {
      logo: {
        gutter: '20px'
      }
    }
  }, document.getElementById('redoc-container'))
</script>
</body>
</html>