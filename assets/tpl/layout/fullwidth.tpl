  <body>
    <script src="{ASSETS_URL}jquery/jquery-3.3.1.min.js"></script>
    <script src="{ASSETS_URL}popper/popper.min.js"></script>
    <script src="{ASSETS_URL}bootstrap/js/bootstrap.min.js"></script>
    <script src="{ASSETS_URL}particles/particles.js"></script>
    <script src="{ASSETS_URL}jquery-validation/dist/jquery.validate.js"></script>  
    <script src="{ASSETS_URL}toastr/build/toastr.min.js"></script>
    <link href="{ASSETS_URL}custom/pages.css" rel="stylesheet">
    <link href="{ASSETS_URL}toastr/build/toastr.min.css" rel="stylesheet"/>
    <div id="particles-js"></div>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container removeyp">
        <a class="navbar-brand" href="index.html">CoreZ</a>
        {NAVIGATION}
        <div class="d-none d-md-block">{SELECT_LANGUAGE}</div>
      </div>
    </nav>
    <div class="container">
      <div class="jumbotron mt-5">
        {CONTENT}
      </div>      
      <footer class="text-center">
        <p class="mt-5 mb-3 copyright">{TEXT_COPYRIGHT_FOOTER}</p>
      </footer>
    </div>
    <script src="{ASSETS_URL}custom/app.js"></script>     
  </body>