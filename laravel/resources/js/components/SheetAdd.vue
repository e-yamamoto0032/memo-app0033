<template>
    <div id="overlay" class="row">
        <div id="content" class="col-sm-6">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-link btn-sm" @click="$emit('close')">閉じる</button>
                    </div>
                    <form class="" @submit.prevent="addSheet">
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">シート名</label>
                            <div class="col-sm-8">
                                <input v-model="title" type="text" class="form-control" id="title"
                                       placeholder="シート名を入力" value="">
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
                                <button type="submit" class="btn btn-info" @click="$emit('close')">シートを追加</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
                title: '',
                body: '',
                deadline: '',
        }
    },
    methods: {
        addSheet() {
            this.$store.dispatch('sheet/addSheet', {
                title:this.title,
                body:this.body,
                deadline:this.deadline,
                status: 0,
                user_id:this.userid
            })
        }
    },
    computed: {
        userid() {
            return this.$store.getters['auth/userid']
        },
    }
}


</script>

<style>
#overlay {
    /*　要素を重ねた時の順番　*/
    z-index: 1;

    /*　画面全体を覆う設定　*/
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
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




