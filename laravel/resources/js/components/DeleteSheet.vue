<template>
    <div id="overlay" class="row">
        <div id="content" class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-link btn-sm" @click="$emit('close')">閉じる</button>
                    </div>
                    <h5 class="card-title">シート名：{{ delete_title }}</h5>
                    <p class="card-text">このシートを削除してもよろしいですか？</p>
                    <div class="d-flex justify-content-center">
                        <div>
                            <button type="submit" class="btn btn-danger" @click="deleteSheet">シートを削除</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        delete_id: {
            type: Number,
        },
        user_id: {
            type: Number,
        },
        delete_title: {
            type: String
        }
    },
    methods: {
        deleteSheet() {
            axios.delete('/api/sheets/' + this.delete_id, {
                data:
                    {
                        id: this.delete_id
                    }
            })
            //     .then(() => {
            //     location.reload()
            // })
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
