<template>
    <form :class="classList" @submit.prevent="addList">
        <input v-model="title"
               type="text"
               class="text-input"
               placeholder="タスクの追加"
               @focusin="startEditing"
               @focusout="finishEditing"
        >
        <button type="submit"
                class="add-button"
                v-if="isEditing || titleExists">
            Add
        </button>
    </form>

</template>


<script>
export default {
    data: function () {
        return {
            title: '',
            isEditing: false,
        }
    },

    computed: {
        classList() {
            const classList = ['addlist']
            if (this.isEditing) {
                classList.push('active')
            }
            if (this.titleExists) {
                classList.push('addable')
            }
            return classList
        },
        titleExists() {
            return this.title.length > 0
        },
        sheet_id: function () {
            return this.$route.params.sheet_id;
        },
    },

    methods: {
        addList: function () {
            this.$store.dispatch('task/addlist', {
                title: this.title,
                sheet_id: this.sheet_id,
                order: 0

            })
            this.title = ''
        },
        startEditing() {
            this.isEditing = true
        },
        finishEditing() {
            this.isEditing = false
        },
    }
}

</script>
