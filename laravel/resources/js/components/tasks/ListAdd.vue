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
        tasks_max() {
            if (Math.max.apply(null, this.tasks_id) === -Infinity) {
                return 1
            }
            return Math.max.apply(null, this.tasks_id) + 1
        }
    },

    methods: {
        addList: function () {
            this.$store.dispatch('task/addlist', {
                title: this.title,
                sheet_id: this.sheet_id,
                order: this.tasks_max

            }).then(() => {
                this.title = ''
                location.reload()
            })
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
