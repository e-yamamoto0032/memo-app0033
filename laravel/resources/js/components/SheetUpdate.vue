<template>
    <div id="overlay" class="row">
        <div id="content" class="col-sm-6">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-link btn-sm" @click="$emit('close')">閉じる</button>
                    </div>
                    <form class="" @submit.prevent="updateSheet">
                        <div v-if="updateSheetErrors" class="errors">
                            <ul v-if="updateSheetErrors.title">
                                <li v-for="msg in updateSheetErrors.title" :key="msg">{{ msg }}</li>
                            </ul>
                            <ul v-if="updateSheetErrors.body">
                                <li v-for="msg in updateSheetErrors.body" :key="msg">{{ msg }}</li>
                            </ul>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">シート名{{ update_id }}</label>
                            <div class="col-sm-8">
                                <input v-model="title" type="text" class="form-control" id="title"
                                       placeholder="シート名を入力">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-sm-4 col-form-label">内容</label>
                            <div class="col-sm-8">
                                <textarea v-model="body" rows="4" class="form-control" id="body"
                                          placeholder="タスクの内容を入力">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deadline" class="col-sm-4 col-form-label">期日</label>
                            <div class="col-sm-8">
                                <input v-model="deadline" type="date" class="form-control" id="deadline"
                                       placeholder="タスクの期日を入力">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>
                                <button type="submit" class="btn btn-warning" >シートを変更</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: {
        update_title: {
            type: String,
            required: true
        },
        update_body: {
            type: String,
            required: true
        },
        update_deadline: {
            type: String,
        },
        update_id: {
            type: Number,
        },
        update_status: {
            type: Number,
        },
        update_end_date: {
            type: String,
        }

    },
    data() {
        return {
            title: this.$props.update_title,
            body: this.$props.update_body,
            deadline: moment(this.$props.update_deadline, "YYYY年MM月DD日").format("YYYY-MM-DD")
        }

    },

    methods: {
        async updateSheet() {
            await this.$store.dispatch('sheet/updateSheet', {
                title: this.title,
                body: this.body,
                deadline: this.deadline,
                id: this.update_id,
            })
            if (this.apiStatus) {
                location.reload()
            }
        },
    },
    computed: {
        userid() {
            return this.$store.getters['auth/userid']
        },
        apiStatus() {
            return this.$store.state.sheet.apiStatus
        },
        updateSheetErrors() {
            return this.$store.state.sheet.sheetErrorMessages
        }
    }

}


</script>

<style>
#overlay {
    /*　要素を重ねた時の順番　*/
    z-index: 1;

    /*　画面全体を覆う設定　*/
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);

    /*　画面の中央に要素を表示させる設定　*/
    display: flex;
    align-items: center;
    justify-content: center;

}

#content {
    z-index: 2;
    width: 50%;
    padding: 1em;
    background: #fff;
}
</style>




