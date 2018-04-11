  <body>
    <link href="{ASSETS_URL}custom/signin.css" rel="stylesheet">
    <div id="particles-js"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 text-right">
          {SELECT_LANGUAGE}  
        </div>
      </div>
      <div class="row justify-content-md-center mt-4">
        <div class="col-12 text-center">
          <form class="form-signin" action="reset-password.html" class="form form-validation" method="post" id="submitform" name="submitform" role="form">
            <input type="hidden" id="s" name="s" value="submit">
            <a href="index.html"><img src="{ASSETS_URL}images/logo.png" alt="" width="72" height="72"></a>
            <h1 class="h1logo mb-4">CoreZ</h1>
            <div class="whitetron">        
              <h2 class="jumbotron-heading pb-3">{TITLE}</h2> 
              {MESSAGE}
              {MESSAGE_VALIDATION}
              <label for="key" class="sr-only">{TEXT_KEY}</label>
              <input type="text" id="key" name="key" class="form-control inputtop" placeholder="{TEXT_KEY}" required autofocus>
              <label for="password" class="sr-only">{TEXT_PASSWORD}</label>
              <input type="password" id="password" name="password" class="form-control inputcenter" placeholder="{TEXT_PASSWORD}" required>
              <label for="repeatpassword" class="sr-only">{TEXT_REPEAT_PASSWORD}</label>
              <input type="password" id="repeatpassword" name="repeatpassword" class="form-control inputbottom" placeholder="{TEXT_REPEAT_PASSWORD}" required> 
              <button class="btn btn-lg btn-primary btn-block" type="submit">{TEXT_CHANGE_PASSWORD}</button>
            </div>            
            <div class="btn-group btn-group-sm mt-3" role="group" aria-label="">
              <a href="index.html" class="btn btn-outline-light">{TEXT_SIGN_IN}</a>
              <a href="register.html" class="btn btn-outline-light">{TEXT_REGISTER}</a>        
            </div>
            <p class="mt-5 mb-3 copyright">{TEXT_COPYRIGHT_FOOTER}</p>
          </form>
        </div>
      </div>
    </div>
    <script src="{ASSETS_URL}jquery/jquery-3.3.1.min.js"></script>
    <script src="{ASSETS_URL}popper/popper.min.js"></script>
    <script src="{ASSETS_URL}bootstrap/js/bootstrap.min.js"></script>
    <script src="{ASSETS_URL}particles/particles.js"></script>
    <script src="{ASSETS_URL}jquery-validation/dist/jquery.validate.js"></script>
    <script src="{ASSETS_URL}custom/app.js"></script>
    <script>
      $().ready(function() {
        var container = $('#validationerror');
        $("#submitform").validate({
          errorContainer: container,
          errorLabelContainer: $(container),
          rules: {
            repeatpassword: {
              required: true,
              equalTo: "#password"
            }
          },
          messages: {
            key: "{TEXT_ERROR_KEY_MISSING}",
            password: "{TEXT_ERROR_PASSWORD_MISSING}",
            repeatpassword: {
              required: "{TEXT_ERROR_REPEATPASSWORD_MISSING}",
              equalTo: "{TEXT_ERROR_REPEATPASSWORD_NOTEQUAL}"
            }
          }
        });
      });
    </script>    
  </body>