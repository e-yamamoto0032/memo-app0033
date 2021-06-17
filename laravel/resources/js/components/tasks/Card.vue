<template>
    <div class="task-card">
        <button class="close-button" @click="removeCardFromList">
            ×
        </button>
        <div class="body">
            {{ body }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        body: {
            type: String,
            required: true
        },
        listIndex: {
            type: Number,
            required: true
        },
        cardIndex: {
            type: Number,
            required: true
        },
        task_order: {
            type: Number,
            required: true
        },
        id: {
            type: Number,
            required: true
        }
    },

    computed: {
        userid() {
            return this.$store.getters['auth/userid']
        }
    },

    methods: {
        removeCardFromList() {
            if (confirm('本当にこのカードを削除しますか？')) {
                axios.delete('/api/cards/' + this.id, {
                    data:
                        {
                            id: this.id,
                            user_id: this.userid
                        }
                }).then(() => {
                    location.reload()
                })
            }
        }
    },
}
</script>
