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
                          :id="item.id"
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
        movingCard: async function () {
            let taskIds = []
            for (const elem of this.taskList) {
                taskIds.push(elem.id)
            }

            let cards = []
            for (const elem of this.taskList) {
                cards.push(elem.cards)
            }

            let cardIdsArray = []
            for (let i = 0; i < cards.length; i++) {
                let cardIds = []
                for(const elem of cards[i]){
                    cardIds.push(elem.id)
                }
                cardIdsArray.push(cardIds)
            }

            await this.clearTask()
            axios.post('/api/cards/sort', {
                taskIds: taskIds,
                cardIdsArray: cardIdsArray

            }).then(() => {
                this.getTask()
            })
        },
        movingList: async function () {
            let taskIds = []
            for (const elem of this.taskList) {
                taskIds.push(elem.id)
            }
            await this.clearTask()
            axios.post('/api/tasks/sort', {
                taskIds: taskIds
            }).then(() => {
                this.getTask()
            })
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
            }).then(() => {
                var self = this;
                axios.get('/api/cards').then(function (response) {
                    self.res = response.data.sort(function (a, b) {
                        if (a.order > b.order) {
                            return 1;
                        } else {
                            return -1;
                        }
                    })
                    self.res.forEach(function (elem) {
                        self.$store.dispatch('task/dbCard', {
                            id: elem.id,
                            body: elem.body,
                            order: elem.order,
                            sheet_id: elem.sheet_id,
                            task_id: elem.task_id
                        })
                    })
                })
            })
        },
        async clearTask() {
            await this.$store.dispatch('task/resetTask')
        }
    },
    created() {
        this.getTask()
        this.clearTask()
        this.request()
    },

}


</script>

<style>
[v-cloak] {
    display: none;
}
</style>
