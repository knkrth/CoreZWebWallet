        <h1 class="jumbotron-heading pb-3">{TITLE}</h1> 
        <form action="account.html" class="form form-validation" method="post" id="submitform" name="submitform" role="form">
          <input type="hidden" id="s" name="s" value="submit">
          {MESSAGE}
          {MESSAGE_VALIDATION}
          <label for="password" class="sr-only">{TEXT_CURRENT_PASSWORD}</label>
          <input type="password" id="currentpassword" name="currentpassword" class="form-control inputtop" placeholder="{TEXT_CURRENT_PASSWORD}" required>          
          <label for="password" class="sr-only">{TEXT_NEW_PASSWORD}</label>
          <input type="password" id="password" name="password" class="form-control inputcenter" placeholder="{TEXT_NEW_PASSWORD}" required>
          <label for="repeatpassword" class="sr-only">{TEXT_REPEAT_PASSWORD}</label>
          <input type="password" id="repeatpassword" name="repeatpassword" class="form-control inputbottom" placeholder="{TEXT_REPEAT_PASSWORD}" required>      
          <button class="btn btn-lg btn-primary btn-block" type="submit">{TEXT_SAVE}</button>
        </form>

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
                currentpassword: "{TEXT_ERROR_PASSWORD_MISSING}",
                password: "{TEXT_ERROR_PASSWORD_MISSING}",
                repeatpassword: {
                  required: "{TEXT_ERROR_REPEATPASSWORD_MISSING}",
                  equalTo: "{TEXT_ERROR_REPEATPASSWORD_NOTEQUAL}"
                }
              }
            });
          });
        </script>         