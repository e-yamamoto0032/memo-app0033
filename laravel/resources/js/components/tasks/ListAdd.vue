<template>
    <form :class="classList" @submit.prevent="addList">
        <div v-if="addTaskErrors" class="errors">
            <ul v-if="addTaskErrors.title">
                <li v-for="msg in addTaskErrors.title" :key="msg">{{ msg }}</li>
            </ul>
        </div>
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
            追加
        </button>
    </form>

</template>


<script>
import {mapState} from 'vuex'

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
        sheet_id() {
            return this.$route.params.sheet_id;
        },

        ...mapState(
            {
                tasks: state => state.task.lists,
                task_length: state => state.task.lists.length,
            }
        ),
        tasks_id() {
            return this.tasks.map(item => item.id)
        },
        apiStatus() {
            return this.$store.state.task.apiStatus
        },
        addTaskErrors() {
            return this.$store.state.task.taskErrorMessages
        },
        userid() {
            return this.$store.getters['auth/userid']
        },
    },

    methods: {
        async addList() {
            await this.$store.dispatch('task/addlist', {
                title: this.title,
                sheet_id: this.sheet_id,
                order: this.task_length,
                user_id: this.userid
            })
            if (this.apiStatus) {
                location.reload()
            }
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
