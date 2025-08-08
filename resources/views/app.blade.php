<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FinTrust App</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('loader.css') }}" />
  @vite(['resources/js/app.js'])
</head>

<body>
  @inertia
  
  <script>
    try {
      const loaderColor = localStorage.getItem('sneat-initial-loader-bg') || '#FFFFFF'
      const primaryColor = localStorage.getItem('sneat-initial-loader-color') || '#696CFF'

      if (loaderColor && loaderColor !== 'undefined')
        document.documentElement.style.setProperty('--initial-loader-bg', loaderColor)

      if (primaryColor && primaryColor !== 'undefined')
        document.documentElement.style.setProperty('--initial-loader-color', primaryColor)
    } catch (e) {
      console.log('Error setting loader colors:', e)
    }
  </script>
</body>

</html>
