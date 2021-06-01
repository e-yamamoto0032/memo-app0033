<template>
    <div>
        <header>
            <h3 class="sheet-title">{{ sheet_title }}</h3>
        </header>
        <main>
            <p class="deadline">期限: {{ sheet_deadline }}</p>
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
import {mapState} from 'vuex'

export default {
    components: {
        draggable,
        ListAdd,
        List
    },

    computed: {
        userid() {
            return this.$store.getters['auth/userid']
        },
        totalCardCount() {
            return this.lists.length
        },
        sheet_id: function () {
            return this.$route.params.sheet_id;
        },
        ...mapState(
            {
                lists: state => state.task.lists
            }
        ),
        sheet_title() {
            return this.$store.getters['sheet/taskSheet'].title
        },
        sheet_deadline() {
            return this.$store.getters['sheet/taskSheet'].deadline
        },
    },
    methods: {
        movingCard: function () {
            this.$store.dispatch('updateList', {lists: this.lists})
        },
        movingList: function () {
            this.$store.dispatch('updateList', {lists: this.lists})
        },
        request: function () {
            var self = this;
            axios.get('/api/sheets/' + this.sheet_id).then(function (response) {
                self.res = response.data;
                self.$store.dispatch('sheet/taskSheet', {
                    id: self.res.id,
                    title: self.res.title,
                    deadline: self.res.deadline,
                    user_id: self.res.user_id
                })

            })
        }
    },
    created() {
        this.request()

    }
}


</script>
