<template>
    <div>
        <header>
            {{ username }}さんのシート一覧
        </header>

        <div>
            <p>All: 0 sheets</p>
            <div class="h5 mb-3">作業中</div>
            <sheet/>
            <hr>
            <div class="h5 mb-3">完了済</div>
            <sheet-done/>
        </div>
    </div>
</template>

<script>
import SheetAdd from "./SheetAdd";
import SheetDone from "./SheetDone";
import Sheet from "./Sheet";
import {mapState} from 'vuex'

export default {
    components: {
        Sheet,
        SheetAdd,
        SheetDone
    },
    computed: {
        username() {
            return this.$store.getters['auth/username']
        },
    }

}
</script>

<style>

</style>
