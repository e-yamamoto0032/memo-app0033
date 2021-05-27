<template>
    <div>
        <ul class="nav nav-pills justify-content-center">
            <li
                class="col-sm-2 nav-item text-center"
                :class="{'nav-link active': tab === 1}"
                @click="tab = 1"
            >Login</li>
            <li
                class="col-sm-2 nav-item text-center"
                :class="{'nav-link active': tab === 2}"
                @click="tab = 2"
            >Register</li>
        </ul>
        <div class="row justify-content-center" v-show="tab === 1">
            <form class="col-sm-5 form-group mt-3 " @submit.prevent="login">
                <label for="login-email">Email</label>
                <input type="text" class="form-control" id="login-email" v-model="loginForm.email">
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" v-model="loginForm.password">
                <div class="form__button">
                    <button type="submit" class="btn btn-success">login</button>
                </div>
            </form>
        </div>
        <div class="row justify-content-center" v-show="tab === 2">
            <form class="col-sm-5 form-group mt-3" @submit.prevent="register">
                <label for="username">Name</label>
                <input type="text" class="form-control" id="username" v-model="registerForm.name">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" v-model="registerForm.email">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="registerForm.password">
                <label for="password-confirmation">Password (confirm)</label>
                <input type="password" class="form-control" id="password-confirmation" v-model="registerForm.password_confirmation">
                <div class="form__button">
                    <button type="submit" class="btn btn-success">register</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            tab: 1,
            loginForm: {
                email: '',
                password: ''
            },
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        async login () {
            await this.$store.dispatch('auth/login', this.loginForm)

            this.$router.push({ name: 'board'})
        },
        async register () {
            await this.$store.dispatch('auth/register', this.registerForm)

            this.$router.push({ name: 'board'})
        }
    },
    computed: {
        userid () {
            return this.$store.getters['auth/userid']
        },
        username() {
            return this.$store.getters['auth/username']
        },

    }
}
</script>
