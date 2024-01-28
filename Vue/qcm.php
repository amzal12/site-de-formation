<div class="index_cours">

<?php
if($_SESSION['admin'] == 'oui'){
  echo'
  <form class="admin_add_cour" action="" method="POST" enctype="multipart/form-data">
  <h2>Modifier QMC</h2>
    <input type="file" name="fileToUpload">
    <input class="suppr_newTopic" type="submit" name="qcm" value="Publier">
  </form>';
}
?>
<div class="quiz-container" id="quiz">
    <div class="quiz-header">
      <h2 style="padding:20px 0;">QCM</h2>
      <h3>Niveau : <?php echo $qcm['diffi']?></h3>
      <br/>
      <p id="numq">/10</p>
      <h2 id="question">Question Text</h2>
      <ul style="padding:20px 0;">

        <li id="li1" class="li_qcm">
          <input type="radio" name="answer" id="a" class="answer">
          <label for="a" id="a_text">Answer</label>
        </li>

        <li  id="li2" class="li_qcm">
          <input type="radio" name="answer" id="b" class="answer">
          <label for="b" id="b_text">Answer</label>
        </li>

        <li id="li3" class="li_qcm">
          <input type="radio" name="answer" id="c" class="answer">
          <label for="c" id="c_text">Answer</label>
        </li>

        <li id="li4" class="li_qcm">
          <input type="radio" name="answer" id="d" class="answer">
          <label for="d" id="d_text">Answer</label>
        </li>

      </ul>
      <button id="submit" class="btn_modifprofile" style="font-size:20px;">Question Suivante</button>
    </div>

    

  </div>

</div>

<script>




const quizData = [
    <?php
    foreach ($qcm_xml->children() as $question) {
        echo "{";
        echo "question: '".addslashes($question->Contenu)."'\n,";
        foreach($question->Proposition as $prop){
            echo $prop->nom.": '".addslashes($prop->texte)."'\n,";
        }
        echo "correct:'".addslashes($question->Reponse)."'";
        
        echo "},";
    }
    ?>
];

const quiz= document.getElementById('quiz')
const answerEls = document.querySelectorAll('.answer')
const questionEl = document.getElementById('question')
const a_text = document.getElementById('a_text')
const b_text = document.getElementById('b_text')
const c_text = document.getElementById('c_text')
const d_text = document.getElementById('d_text')

const submitBtn = document.getElementById('submit')


let currentQuiz = 0
let score = 0

loadQuiz()

function loadQuiz() {

    deselectAnswers()

    const currentQuizData = quizData[currentQuiz]

    questionEl.innerText = currentQuizData.question
    a_text.innerText = currentQuizData.a
    b_text.innerText = currentQuizData.b
    c_text.innerText = currentQuizData.c
    d_text.innerText = currentQuizData.d
}

function deselectAnswers() {
    answerEls.forEach(answerEl => answerEl.checked = false)
}

function getSelected() {
    let answer
    answerEls.forEach(answerEl => {
        if(answerEl.checked) {
            answer = answerEl.id
        }
    })
    return answer
}

document.getElementById('numq').innerText = currentQuiz+1
var text = document.createTextNode(<?php echo "'/".$nbQuestions."'";?>);
document.getElementById('numq').appendChild(text);

submitBtn.addEventListener('click', () => {
    const answer = getSelected()
    if(answer) {
       if(answer === quizData[currentQuiz].correct) {
           score++
       }
       currentQuiz++

       if(currentQuiz == quizData.length-1){
         document.getElementById('submit').innerText = "Terminer le QCM"
       }
       if(currentQuiz < quizData.length) {
           loadQuiz()
           document.getElementById('numq').innerText = currentQuiz+1
           var text = document.createTextNode(<?php echo "'/".$nbQuestions."'";?>);
           document.getElementById('numq').appendChild(text);
       } else if(score < quizData.length/2){
        <?php
        echo'
           quiz.innerHTML = `
           <h2>${score}/${quizData.length} BOF...</h2>
        
           <button class="btn_disconnect" onclick="window.location.href=\'?p=indCours&idG='.$id_groupe.'\'">Retour cours</button>
           <button class="btn_modifprofile" onclick="location.reload()">Refaire QCM</button>
           `
           ';
        ?>
       } else {
           <?php
            echo'
           quiz.innerHTML = `
           <h2>${score}/${quizData.length} Bravo!</h2>
        
           <button class="btn_modifprofile" onclick="window.location.href=\'?p=indCours&idG='.$id_groupe.'&niv='.$qcm['id_qcm'].'\'">Valider QCM</button>
           `
           ';
            ?>
       }
    }
})



</script>