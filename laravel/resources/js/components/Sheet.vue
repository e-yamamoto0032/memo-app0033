<template>

    <div>
        <div>
            <div class="row">
                <div class="btn-group btn-group-sm ml-5">
                    <div class="btn btn-primary" aria-current="page">昇順</div>
                    <div class="btn btn-primary">降順</div>
                </div>
                <div @click="openModal" style="cursor: hand; cursor:pointer;">
                    <i class="far fa-plus-square pt-3 ml-3"></i>
                    シートを追加
                </div>
                <sheet-add @close="closeModal" v-show="showContent"/>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body d-flex flex-row">
                            <div>
                                <h6 class="card-title">シートのタイトルのテスト</h6>
                                <p class="card-text">シートの内容のテスト</p>
                                <p class="card-text">期日　2021年05月01日</p>
                            </div>
                            <div class="ml-auto card-text">
                                <div class="dropdown">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-pen mr-1"></i>記事を更新する
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger">
                                            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success btn-sm">完了</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import SheetAdd from './SheetAdd'

export default {
    components: {
        SheetAdd,
    },
    data() {
        return {
            showContent: false,
        }
    },
    methods: {
        openModal() {
            this.showContent = true
        },
        closeModal() {
            this.showContent = false
        }
    }
}

</script>

