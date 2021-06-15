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
              />
            </draggable>
            <card-add :listIndex="listIndex"/>
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
    },
}
</script>
