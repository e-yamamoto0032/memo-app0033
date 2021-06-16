<template>
    <form :class="classList" @submit.prevent="addCardToList">
        <input type="text"
               class="text-input"
               v-model="body"
               placeholder="カードの追加"
               @focusin="startEditing"
               @focusout="finishEditing"
        >
        <button type="submit"
                class="add-button"
                v-if="isEditing || bodyExists"
                @click="$emit('error')"
        >
            追加
        </button>
    </form>
</template>

<script>
export default {
    props: {
        listIndex: {
            type: Number,
            required: true,
        },
        task_id: {
            type: Number,
            required: true,
        },
        task_order: {
            type: Number,
            required: true
        },
    },
    data: function () {
        return {
            body: '',
            isEditing: false,
        }
    },

    computed: {
        classList() {
            const classList = ['addcard']
            if (this.isEditing) {
                classList.push('active')
            }
            if (this.bodyExists) {
                classList.push('addable')
            }
            return classList
        },
        bodyExists() {
            return this.body.length > 0
        },
        userid() {
            return this.$store.getters['auth/userid']
        },
        sheet_id: function () {
            return this.$route.params.sheet_id;
        },
        apiStatus() {
            return this.$store.state.task.apiStatus
        },
    },

    methods: {
        startEditing: function () {
            this.isEditing = true
        },
        finishEditing: function () {
            this.isEditing = false
        },
        addCardToList: function () {
            this.$store.dispatch('task/addCardToList', {
                body: this.body,
                task_order: this.task_order,
                order: 0,
                task_id: this.task_id,
                user_id: this.userid,
                sheet_id: this.sheet_id
            })
            if (this.apiStatus) {
                location.reload()
            }
        }
    }
}
</script>
