<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Soal Online
                        <span class="float-right"
                            >{{ questionIndex }}/{{ questions.length }}</span
                        >
                    </div>

                    <div class="card-body">
                        <span class="float-right">{{ time }}</span>
                        <div v-for="(question, index) in questions">
                            <div v-show="index == questionIndex">
                                {{ question.question }}

                                <li
                                    class="nav-link"
                                    v-for="hasil in question.answers"
                                >
                                    <input
                                        type="radio"
                                        name=""
                                        :value="
                                            hasil.is_correct == true
                                                ? 123
                                                : hasil.id
                                        "
                                        :name="index"
                                        v-model="userResponse[index]"
                                        @click="pilihans(question.id, hasil.id)"
                                    />
                                    {{ hasil.answer }}
                                </li>
                            </div>
                        </div>
                        <div v-show="questionIndex != questions.length">
                            <button
                                v-if="questionIndex >= 1"
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

                        <div v-show="questionIndex == questions.length">
                            <p>
                                <center>
                                    <button
                                        class="btn btn-success  mt-2"
                                        @click="tamat()"
                                        v-show="
                                            questionIndex == questions.length
                                        "
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
            questionIndex: 0,
            quizResult: this.quizQuestion.result,
            userResponse: Array(this.quizQuestion.length).fill(false),
            currentQuestion: 0,
            currentAnswer: 0,
            submits: 1,
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
                axios.post("/quiz/create", {
                    answerId: this.currentAnswer,
                    questionId: this.currentQuestion,
                    quizId: this.quizid,
                    submit: this.submits
                });
                window.location.reload();
            } else {
                window.onbeforeunload = function() {
                    return "Anda Akan Mengakhiri kuiz ini?";
                };
            }
            return minsec;
        }
    },
    methods: {
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
                return val == 123;
            }).length;
        },
        postUser() {
            // untuk quizid Jangan pake Id besar karena nanti error
            axios
                .post("/quiz/create", {
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
            if (confirm("Anda Yakin Ingin menyelesaikan Quiz?")) {
                axios
                    .post("/quiz/create", {
                        answerId: this.currentAnswer,
                        questionId: this.currentQuestion,
                        quizId: this.quizid,
                        submit: this.submits
                    })
                    .then(response => {
                        this.$toasted.show("Sudah Selesai", {
                            type: "success",
                            duration: "3000"
                        });
                        window.location.href = "http://127.0.0.1:8000/home";
                    })
                    .catch(errors => {
                        this.$toasted.show("Gagal", {
                            type: "error",
                            duration: "3000"
                        });
                    });
            }
        }
    }
};
</script>
