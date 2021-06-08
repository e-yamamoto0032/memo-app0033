<template>
    <div v-cloak>
        <header>
            <h3 class="sheet-title">{{ sheet_title }}</h3>
        </header>
        <main>
            <p class="deadline">期限: {{ sheet_deadline }}</p>
            <p class="all-task">All: {{ totalCardCount }} tasks</p>
            <div class="list-index">
                <draggable :list="taskList"
                           @end="movingList"
                           class="list-index">
                    <list v-for="(item, index) in taskList"
                          :key="item.id"
                          :title="item.title"
                          :cards="item.cards"
                          :order="item.order"
                          :listIndex="index"
                          @change="movingCard"
                    />
                </draggable>
                <list-add
                />
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
            return this.taskList.length
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
        taskList() {
            const tasks = this.lists.filter(x => x.sheet_id == this.sheet_id)
            return tasks.sort(function (a, b) {
                if (a.order > b.order) {
                    return 1;
                } else {
                    return -1;
                }
            })
        },
    },
    methods: {
        movingCard: function () {
            this.$store.dispatch('task/updateList', {lists: this.lists})
        },
        movingList: function () {
            this.$store.dispatch('task/updateList', {lists: this.lists})
        },
        request: async function () {
            var self = this;
            await axios.get('/api/sheets/' + this.sheet_id).then(function (response) {
                if (response.status === 401 || response.status === 403) {
                    location.href = '/';
                }
                self.res = response.data;
                self.$store.dispatch('sheet/taskSheet', {
                    id: self.res.id,
                    title: self.res.title,
                    deadline: self.res.deadline,
                    user_id: self.res.user_id
                })
            })
        },
        getTask() {
            var self = this;
            axios.get('/api/tasks').then(function (response) {
                self.res = response.data;
                self.res.forEach(function (elem) {
                    self.$store.dispatch('task/dblist', {
                        id: elem.id,
                        title: elem.title,
                        order: elem.order,
                        sheet_id: elem.sheet_id,
                    })
                })
            })
        },
        async clearTask() {
            await this.$store.dispatch('task/resetTask')
        }
    },
    created() {
        this.clearTask()
        this.request()
        this.getTask()

    }
}


</script>

<style>
[v-cloak] {
    display: none;
}
</style>
