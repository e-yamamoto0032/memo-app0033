<template>
    <div>
        <header>
            {{ username }}さんのシート一覧
        </header>

        <div>
            <p>現在作業中: {{ totalSheet }} sheets</p>
            <div class="h5 mb-3">作業中</div>
            <div class="row">
                <div class="btn-group btn-group-sm ml-5">
                    <div class="btn btn-primary" aria-current="page" @click="sheetOrder = 0">昇順</div>
                    <div class="btn btn-primary" @click="sheetOrder = 1">降順</div>
                </div>
                <div @click="openModal" style="cursor: hand; cursor:pointer;">
                    <i class="far fa-plus-square pt-3 ml-3"></i>
                    シートを追加
                </div>
                <sheet-add @close="closeModal" v-show="showContent"/>
            </div>
            <div class="card-deck justify-content-center">
                <div v-for="(item, index) in workSheets">
                    <sheet
                        :sheetId="item.id"
                        :title="item.title"
                        :body="item.body"
                        :deadline="item.deadline"
                        :status="item.status"
                        :end_date="item.end_date"
                        :user_id="item.user_id"
                        :sheetIndex="index"
                    />
                </div>
            </div>

            <hr>
            <div class="h5 mb-3">完了済</div>
            <div class="row">
                <div class="btn-group btn-group-sm ml-5">
                    <div class="btn btn-primary" aria-current="page" @click="doneOrder = 0">昇順</div>
                    <div class="btn btn-primary" @click="doneOrder = 1">降順</div>
                </div>
            </div>
            <div class="card-deck justify-content-center">
                <div v-for="(item, index) in doneSheets">
                    <sheet-done
                        :sheetId="item.id"
                        :title="item.title"
                        :body="item.body"
                        :end_date="item.end_date"
                        :status="item.status"
                        :user_id="item.user_id"
                        :sheetIndex="index"

                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SheetAdd from "./SheetAdd";
import SheetDone from "./SheetDone";
import Sheet from "./Sheet";
import moment from "moment";
// import {mapState} from 'vuex'

export default {
    components: {
        Sheet,
        SheetAdd,
        SheetDone
    },
    computed: {
        username() {
            return this.$store.getters['auth/username']
        },
        userid() {
            return this.$store.getters['auth/userid']
        },
        sheets() {
            return this.$store.getters['sheet/getSheet']
        },

        workSheets() {
            const workingSheets = this.sheets.filter(x => x.status === 0)
            const doSheets = workingSheets.filter(y => y.user_id === this.userid)
            if (this.sheetOrder === 0) {
                return doSheets.sort(function (a, b) {
                    if (a.deadline > b.deadline) {
                        return 1;
                    } else {
                        return -1;
                    }
                })
            } else if (this.sheetOrder === 1){
                return doSheets.sort(function (a, b) {
                    if (b.deadline > a.deadline) {
                        return 1;
                    } else {
                        return -1;
                    }
                })
            }
        },
        doneSheets() {
            const endSheets = this.sheets.filter(x => x.status === 1)
            const doneSheets = endSheets.filter(y => y.user_id === this.userid)
            if (this.doneOrder === 0) {
                return doneSheets.sort(function (a, b) {
                    if (a.deadline > b.deadline) {
                        return 1;
                    } else {
                        return -1;
                    }
                })
            } else if (this.doneOrder === 1){
                return doneSheets.sort(function (a, b) {
                    if (b.deadline > a.deadline) {
                        return 1;
                    } else {
                        return -1;
                    }
                })
            }

        },
        totalSheet() {
            return this.workSheets.length
        },
    },
    data() {
        return {
            // sheets: [
            //     {
            //         title: 'タイトル1',
            //         body: '内容1',
            //         deadline: moment("2021-06-01").format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-06-01").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル2',
            //         body: '内容2',
            //         deadline: moment("2021-05-02").format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-05-02").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル3',
            //         body: '内容3',
            //         deadline: moment().format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-03-03").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル4',
            //         body: '内容4',
            //         deadline: moment("2021-06-04").format("YYYY年MM月DD日"),
            //         status: 1,
            //         end_date: moment("2021-06-04").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル5',
            //         body: '内容5',
            //         deadline: moment("2021-05-05").format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-05-05").format("YYYY年MM月DD日"),
            //         user_id: 2,
            //     },
            //     {
            //         title: 'タイトル6',
            //         body: '内容6',
            //         deadline: moment("2021-06-06").format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-06-06").format("YYYY年MM月DD日"),
            //         user_id: 2,
            //     },
            //     {
            //         title: 'タイトル7',
            //         body: '内容7',
            //         deadline: moment("2021-04-07").format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-07-07").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル8',
            //         body: '内容8',
            //         deadline: moment("2021-08-08").format("YYYY年MM月DD日"),
            //         status: 1,
            //         end_date: moment("2021-08-08").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル9',
            //         body: '内容9',
            //         deadline: moment("2021-09-09").format("YYYY年MM月DD日"),
            //         status: 1,
            //         end_date: moment("2021-09-09").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //     {
            //         title: 'タイトル10',
            //         body: '内容10',
            //         deadline: moment("2021-05-10").format("YYYY年MM月DD日"),
            //         status: 0,
            //         end_date: moment("2021-10-10").format("YYYY年MM月DD日"),
            //         user_id: 1,
            //     },
            //
            //
            // ],
            showContent: false,
            sheetOrder: 0,
            doneOrder: 0,
        }
    },
    methods: {
        openModal() {
            this.showContent = true
        },
        closeModal() {
            this.showContent = false
        }
    },
}
</script>

<style>

</style>
