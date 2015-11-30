# icaque-api

### SIGN IN

url: `/login_check`

requirements:

- `_username`
- `_password`

responses:

- 200: OK
    - `token`: a Json Web Token
- 401: Bad credentials
    - `message`


### SIGN UP

url: `/register/`

requirements:

- `fos_user_registration_form[username]`
- `fos_user_registration_form[email]`
- `fos_user_registration_form[plainPassword][first]`
- `fos_user_registration_form[plainPassword][second]`
- `callback`: the url to given in the email to confirm it.

optionals:
- `pattern`: default ***:token***. The pattern of the string to replace with the token in the callback url

responses:

- 200: OK user is created but not enable yet. Need email confirmation.
    - no data
- 201: CREATED user is created and enabled
    - `token`: a Json Web Token
- 400: Bad credentials
    - `global` => array of global form errors
    - `fields` => object of fields errors
