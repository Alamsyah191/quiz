<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Soal Online
                        <span class="float-right"
                            >{{ questionIndex }}/{{
                                questions.length + 1
                            }}</span
                        >
                    </div>

                    <div class="card-body">
                        <span class="float-right">{{ time }}</span>
                        <div v-for="(question, index) in questions">
                            <div v-show="questionIndex == 1">
                                {{ question.question }}

                                <li
                                    class="nav-link"
                                    v-for="pilihan in question.answers"
                                >
                                    <input
                                        type="radio"
                                        :value="
                                            pilihan.is_correct == true
                                                ? true
                                                : pilihan.answer
                                        "
                                        :checked="true"
                                        :name="index"
                                        v-model="userResponse[index]"
                                        @click="
                                            pilihans(question.id, pilihan.id)
                                        "
                                    />
                                    {{ pilihan.answer }}
                                </li>
                            </div>
                        </div>
                        <div v-show="questionIndex == questions.length">
                            <button
                                v-if="questionIndex > 1"
                                class="btn btn-success float-left"
                                @click="prev()"
                            >
                                Prev
                            </button>
                            <button
                                class="btn btn-success float-right"
                                @click="
                                    next();
                                    postUser();
                                "
                            >
                                Next
                            </button>
                        </div>

                        <div v-show="questionIndex != questions.length">
                            <p>
                                <center>
                                    Anda Mendapatkan {{ hasil() }}
                                    {{ questions.length }}
                                    <br />
                                    <button
                                        class="btn btn-success  mt-2"
                                        @click="tamat()"
                                    >
                                        Selesai
                                    </button>
                                </center>

                                <button
                                    class="btn btn-success float-left mt-2"
                                    @click="prev()"
                                >
                                    Prev
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["quizid", "quizQuestion", "jalan", "times"],
    data() {
        return {
            questions: this.quizQuestion,
            questionIndex: 1,
            quizResult: this.quizQuestion.result,
            userResponse: Array(this.quizQuestion.length).fill(false),
            currentQuestion: 0,
            currentAnswer: 0,
            submits: 1,
            selected: "",
            clock: moment(this.times * 60 * 1000)
        };
    },
    mounted() {
        setInterval(() => {
            this.clock = moment(this.clock.subtract(1, "seconds"));
        }, 1000);
    },
    computed: {
        time: function() {
            var minsec = this.clock.format("mm:ss");
            if (minsec == "00:00") {
                alert("Sudah Habis Waktunya");
                window.location.reload();
            }
            return minsec;
        }
    },
    methods: {
        selectedQuiz() {
            this.selected = this.quizResult;
        },
        next() {
            this.questionIndex++;
        },
        prev() {
            this.questionIndex--;
        },
        pilihans(question, answer) {
            (this.currentAnswer = answer), (this.currentQuestion = question);
        },
        hasil() {
            return this.userResponse.filter(val => {
                return val == true;
            }).length;
        },
        postUser() {
            // untuk quizid Jangan pake Id besar karena nanti error
            axios
                .post("/quiz/{quizid}", {
                    answerId: this.currentAnswer,
                    questionId: this.currentQuestion,
                    quizId: this.quizid
                })

                .then(response => {
                    this.$toasted.show("Disimpan", {
                        type: "success",
                        duration: "3000"
                    });
                })
                .catch(error => {
                    alert("GAGALLLLL !!! HAHAHAHHAHAH SABAR YAKK");
                });
        },

        tamat() {
            // untuk quizid Jangan pake Id besar karena nanti error
            axios
                .post("/quiz/{quizid}", {
                    answerId: this.currentAnswer,
                    questionId: this.currentQuestion,
                    quizId: this.quizid,
                    submit: this.submits
                })
                .then(response => {
                    this.$toasted.show(this.oke, {
                        type: "success",
                        duration: "3000"
                    });
                })
                .catch(errors => {
                    this.$toasted.show("Gagal", {
                        type: "error",
                        duration: "3000"
                    });
                });
        }
    }
};
</script>
