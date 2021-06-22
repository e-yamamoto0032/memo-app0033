<template>
    <nav class="navbar navbar-dark bg-dark text-white mt-3 mb-3">
        <div class="navbar__brand" @click="toHome" style="cursor: hand; cursor:pointer;">
            <i class="fas fa-sticky-note fa-lg"></i>
            MemoApp
        </div>
        <div class="navbar__menu">
            <span v-if="isLogin" class="navbar__item" @click="myBoard" style="cursor: hand; cursor:pointer;">
                {{ username }}
            </span>
            <div v-if="isLogin" class="navbar__item">
                <button class="button button--link" @click="logout">Logout</button>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        username() {
            return this.$store.getters['auth/username']
        },


    },
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout')
            await this.$store.dispatch('sheet/resetSheet')
            await this.$store.dispatch('task/resetTask')
            await this.$router.push('/')
        },
        async myBoard() {
            if (location.pathname === '/board') {
                location.reload()
            } else {
                await this.$store.dispatch('sheet/resetSheet')
                await this.$store.dispatch('task/resetTask')
                await this.$router.push({name: 'board'})
            }
        },
        async toHome() {
            if (location.pathname === '/') {
                location.reload()
            } else {
                await this.$store.dispatch('sheet/resetSheet')
                await this.$store.dispatch('task/resetTask')
                await this.$router.push('/')
            }
        }
    }
}
</script>
