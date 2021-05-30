<template>
    <div>
        <header>
            <h3>シートタイトル</h3>
        </header>
        <main>
            <p class="deadline">期限: 2021年05月05日</p>
            <p class="all-task">All: {{ totalCardCount }} tasks</p>
            <div class="list-index">
                <draggable :list="lists"
                           @end="movingList"
                           class="list-index">
                    <list v-for="(item, index) in lists"
                          :key="item.id"
                          :title="item.title"
                          :cards="item.cards"
                          :listIndex="index"
                          @change="movingCard"
                    />
                </draggable>
                <list-add/>
            </div>
        </main>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import ListAdd from './ListAdd.vue'
import List from './List'

export default {
    components: {
        draggable,
        ListAdd,
        List
    },
    computed: {
        totalCardCount() {
            return this.$store.getters.totalCardCount
        },
    },
    methods: {
        movingCard: function () {
            this.$store.dispatch('updateList', {lists: this.lists})
        },
        movingList: function() {
            this.$store.dispatch('updateList', { lists: this.lists })
        }
    }

}


</script>
