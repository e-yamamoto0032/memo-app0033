<template>
    <div class="card mb-3" style="width: 21rem; height: 13rem;">
        <div class="card-body d-flex flex-row">
            <div>
                <h6 class="card-title">{{ title }}</h6>
                <p class="card-text">{{ body }}</p>
                <p class="card-text">期日　{{ deadline }}</p>
                <p class="card-text" v-if="dateAlert === deadline" style="color: blue; font-weight: bold">本日まで！</p>
                <p class="card-text" v-if="dateAlert > deadline" style="color: red; font-weight: bold">期限切れ！</p>
            </div>
            <div class="ml-auto card-text">
                <div class="dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <span class="dropdown-item" @click="openModal" style="cursor: hand; cursor:pointer;">
                            <i class="fas fa-pen mr-1"></i>記事を更新する
                        </span>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-item text-danger" style="cursor: hand; cursor:pointer;">
                            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                        </span>
                    </div>
                    <sheet-update @close="closeModal" v-show="showContent"
                                  :update_id="id"
                                  :update_title="title"
                                  :update_body="body"
                                  :update_deadline="deadline"
                                  :update_status="status"
                                  :update_end_date="end_date"
                    />
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-success btn-sm" @click="doneSheet">完了</button>
        </div>
    </div>
</template>

<script>


import moment from "moment";
import SheetUpdate from "./SheetUpdate";

export default {
    components: {
        SheetUpdate
    },

    props: {
        title: {
            type: String,
            required: true
        },
        body: {
            type: String,
            required: true
        },
        deadline: {
            type: String,
            required: true
        },
        end_date: {
            type: String,
        },
        status: {
            type: Number,
            required: true
        },
        user_id: {
            type: Number,
            required: true
        },
        sheetIndex: {
            type: Number,
            required: true
        },
        id: {
            type: Number,
            required: true
        }

    },
    computed: {
        dateAlert() {
            return moment().format("YYYY年MM月DD日")
        },
    },
    methods: {
        openModal() {
            this.showContent = true
        },
        closeModal() {
            this.showContent = false
        },
        doneSheet() {
            axios.patch('/api/sheets/done/' + this.id, {
                status: this.doneStatus,
                id: this.id,
                end_date: moment().format("YYYY-MM-DD")
            }).then(()=>{
                location.reload()
            })
                // .catch(()=>{
                //エラーハンドリングは別のブランチで実装
            // })

        }

    },
    data() {
        return {
            showContent: false,
            doneStatus: 1
        }
    },

}

</script>

