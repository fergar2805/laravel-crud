$(document).ready(function() {
    // Please write your JS in scripts.js

    console.log('Login ready')

    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    const registerComponent = {
      template: '#signUp',
      name: 'UserLoginComponent',
      data() {
        return {
          user: {
            firstname: '',
            lastname: '',
            email: '',
            password: '',
            passwordCheck: ''
          },
          valid: true
        };
      },
      computed: {
        isFormValid() {
          return (
            this.isValid('firstname') &&
            this.isValid('lastname') &&
            this.isValid('email') &&
            this.isValid('password') &&
            this.isValid('passwordCheck'));
        }
      },

      watch: {
      },

      methods: {
        isValid(prop) {
          switch (prop) {
            case 'firstname':
              return this.user.firstname.length >= 2;
              break;
            case 'lastname':
              return this.user.lastname.length >= 2;
              break;
            case 'email':
              return emailRegex.test(this.user.email);
              break;
            case 'password':
              return this.user.password.length >= 6;
              break;
            case "passwordCheck":
              return this.user.password === this.user.passwordCheck;
              break;
            default:
              return false;
          }

        },
        passwordLength(prop){
            console.log(prop)
        },
        resetUser() {
          this.user.firstname = '';
          this.user.lastname = '';
          this.user.email = '';
          this.user.password = '';
          this.user.passwordCheck = '';
        },
        onSubmit() {
            let data = {
                firstName: this.user.firstname,
                lastName: this.user.lastname,
                email: this.user.email,
                password: this.user.password
            };

            axios
                .post('/user/create', data)
                .then(response => {
                    let user = Object.assign({}, this.user);
                    this.resetUser();
                    this.$emit('register-form', {
                      type: 'register',
                      data: user
                    });

                    /*
                    setTimeout(function(){
                        window.location.href = response.data.url;
                    }, 5000);
                    */
                }).catch(e => {
                $('.alert').show();
                this.resetUser();
                console.log(e.response);
            });
        }
      },

      mounted() {
        // Bonus: Password Validation
        // Can this be refactored?
        // let element = this.$el.querySelector('#passwordcheck');
        // element.addEventListener('blur', () => {
        //   if (!this.isValid('passwordCheck')) {
        //     element.classList.add('invalid');
        //   } else {
        //     element.classList.remove('invalid');
        //   }
        // });
      }
    };

    const signInComponent = {
      template: '#signinIn',
      name: 'SigninComponent',
      data() {
        return {
          user: {
            email: '',
            password: ''
          }
        };
      },
      methods: {
        handleForm() {
          let formvalue = Object.assign({}, this.user);
          this.resetFormValues();
          this.$emit('signin-form', {
            type: 'signin',
            data: formvalue
          });
        },
        resetFormValues() {
          this.user.email = '';
          this.user.password = '';
        },
        isValid(prop) {
          switch (prop) {
            case 'email':
              return emailRegex.test(this.user.email);
              break;
            case 'password':
              return this.user.password.length >= 6;
              break;
            default:
              return false;
          }
        },
        submit(){
            axios
                .post("/user")
                .then((response) => {
                    //const data = response.data; // [{}, {}]
                    //this.users = data;
                    //this.loading = false;
                });
        }
      },

      computed: {
        isFormValid() {
          return this.isValid('email') && this.isValid('password');
        }
      }
    };

    const feedbackComponent = {
      template: '#loginFeedback',
      name: "loginComponent",
      filters: {
        email(input) {
          if (input.email) {
            return input.email;
          } else {
            return '';
          }
        },
        name(input) {
          return input.firstname ? input.firstname : '';
        }
      },

      data() {
        return {
            title : ''
        };
      },
      props: ['feedback'],
      computed: {
        title() {
          return this.feedback.type === 'signin' ?
            'Login Successful!' : 'Sign Up';
        }
      }
    };

    const app = new Vue({
      el: '#app',
      components: {
        register: registerComponent,
        signin: signInComponent,
        feedback: feedbackComponent
      },

      name: 'application',
      data() {
        return {
          feedback: {},
          currentComponent: 'register',
        };

      },
      methods: {
        handleForm(data) {
          this.feedback = data;
          setTimeout(() => {
            this.setView('feedback');
          }, 280);
        },
        isDisabled(btnName) {
          return this.currentComponent === btnName;
        },
        setView(componentName) {
          if (this.currentComponent !== componentName) {
            this.currentComponent = componentName;
          }
        }
      }
    });

  })
