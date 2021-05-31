<template>
    <div class="card mb-3" style="width: 21rem; height: 13rem;">
        <div class="card-body d-flex flex-row">
            <div>
                <h6 class="card-title">{{ title }} (id:{{ id }})</h6>
                <p class="card-text">{{ body }}</p>
                <p class="card-text" v-if="deadline === 'Invalid date'">期日未設定</p>
                <p class="card-text" v-else>期日　{{ deadline }}</p>
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
                        <span class="dropdown-item text-danger" data-toggle="modal" data-target="#exampleModal"
                              @click="deleteModal"
                              style="cursor: hand; cursor:pointer;">
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
                    <delete-sheet @close="closeDeleteModal" v-show="deleteContent"
                                  :delete_id="id"
                                  :delete_title="title"
                                  :user_id="user_id"
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
import DeleteSheet from "./DeleteSheet";

export default {
    components: {
        DeleteSheet,
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
        },
        end_date: {
            type: String,
        },
        status: {
            type: Number,
        },
        user_id: {
            type: Number,
        },
        sheetIndex: {
            type: Number,
        },
        id: {
            type: Number,
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
        deleteModal() {
            this.deleteContent = true
        },
        closeDeleteModal() {
            this.deleteContent = false
        },
        doneSheet() {
            axios.patch('/api/sheets/done/' + this.id, {
                status: this.doneStatus,
                id: this.id,
                end_date: moment().format("YYYY-MM-DD")
            }).then(() => {
                location.reload()
            })
        }

    },
    data() {
        return {
            showContent: false,
            doneStatus: 1,
            deleteContent: false,
        }
    },

}

</script>

