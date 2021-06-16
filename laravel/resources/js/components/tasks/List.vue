<template>
    <div class="list">
        <div class="listheader">
            <p class="list-title">{{ title }}</p>
            <p class="list-count">total: {{ totalCardInList }}</p>
            <div class="deletelist" @click="removeList">×</div>
        </div>
        <draggable group="cards"
                   :list="cards"
                   @end="$emit('change')">
            <card v-for="(item, index) in cards"
                  :body="item.body"
                  :key="item.id"
                  :cardIndex="index"
                  :listIndex="listIndex"
                  :task_order="order"
            />
        </draggable>

        <card-add :listIndex="listIndex"
                  :task_id="id"
                  :task_order="order"
                  @error="errorCardStatus"
        />
        <div v-show="errorCard">
            <div v-if="addCardErrors" class="errors">
                <ul v-if="addCardErrors.body">
                    <li v-for="msg in addCardErrors.body" :key="msg">{{ msg }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import CardAdd from './CardAdd'
import Card from './Card'

export default {
    components: {
        CardAdd,
        Card,
        draggable,
    },

    data() {
        return {
            errorCard: false,
        }
    },

    props: {
        title: {
            type: String,
            required: true
        },
        cards: {
            type: Array,
            required: true
        },
        order: {
            type: Number,
            required: true
        },
        listIndex: {
            type: Number,
            required: true
        },
        id: {
            type: Number,
            required: true
        }
    },

    computed: {
        totalCardInList() {
            return this.cards.length
        },
        userid() {
            return this.$store.getters['auth/userid']
        },
        addCardErrors() {
            return this.$store.state.task.cardErrorMessages
        },
    },

    methods: {
        removeList: function () {
            if (confirm('本当にこのリストを削除しますか？')) {

                axios.delete('/api/tasks/' + this.id, {
                    data:
                        {
                            id: this.id,
                            user_id: this.userid
                        }
                }).then(() => {
                    location.reload()
                })
            }
        },
        errorCardStatus() {
            this.errorCard = true
        }
    },
}
</script>
