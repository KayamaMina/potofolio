<!DOCTYPE html>
    <html lang="ja">
        <head>
        <meta charset="utf-8">
        <style>
        @import url(//fonts.googleapis.com/css?family=Vibur);
       
        body {
            background-color: white;/*背景は画像*/
            background-size:cover;/* 画像サイズにかかわらず背景の大きさに合わせる */

        }

        /* テキスト全体*/
        .logo {
            text-align: center;/* 中央揃え*/
            position: absolute;
            top: 20%;
            }

            .logo b{
            font-size: 23px;
            color: #fee;
            /* 点滅関係なしに文字の影*/
            text-shadow: 0 -20px 80px, 0 0 2px, 0 0 1em #888888, 0 0 0.4em #4e4e4e, 0 0 0.1em #302f2f, 0 10px 2px #000;
        }
        /* テキスト点滅部分 */
        .logo b span{
            animation: blink linear infinite 2s;/* 点滅アニメーション宣言　２秒間間隔*/
        }
        /* 時間がづれて点滅する　３箇所*/
        .logo b span:nth-of-type(3){
            animation: blink linear infinite 3s;/* 点滅アニメーション宣言　３秒間間隔*/
        }
        /* 点滅アニメーション詳細*/
        @keyframes blink {
            78% {
                color: inherit;
                text-shadow: inherit;
            }
            79%{
                color: black;
            }80% {

                text-shadow: none;/* テキストの影を無効 */
            }
            81% {
                color: inherit;
                text-shadow: inherit;/* テキストの影を有効 */
            }
            82% {
                color: whitesmoke;
                text-shadow: none;
            }
            83% {
                color: inherit;
                text-shadow: inherit;
            }
            92% {
                color: gray;
                text-shadow: none;
            }
            92.5% {
                color: inherit;
                text-shadow: inherit;
            }
        }

        
        /* 数字のメニュー欄とリンク欄とボタン*/

        /* 何も入ってない時　もしくはカーソルが当たってない時*/
        input,select {
            color: gray;
            font-size: 20px;
            background: transparent;
            border: 3px solid gray;
            padding: 5px;
            margin-top: 5px;
            transition: all 500ms;
        }
        /* カーソルが当たった時　もしくは何か入ってるとき */
        input,select:hover{
            color: black;
            border-color: black;
            transition: all 500ms;
        }
        input:active{ /*ボタン押したとき （一瞬なる）*/
            color: red;
        }

        </style>
       
        <title>ポートフォリオ（時間差アクション）</title>      
        <script type="text/javascript">//タイマー部分は複雑なのでjavascriptを使う

                /***********************************************

                * JavaScript Alarm Clock- by JavaScript Kit (www.javascriptkit.com)

                ***********************************************/

        var jsalarm={
            padfield:function(f){
                return (f<10)? "0"+f : f//1だとしても01として表示する
            },
            showcurrenttime:function(){
                var dateobj=new Date()
                var ct=this.padfield(dateobj.getHours())+":"+this.padfield(dateobj.getMinutes())+":"+this.padfield(dateobj.getSeconds())
                this.ctref.innerHTML=ct//内容をctとする
                this.ctref.setAttribute("title", ct)//セット
                if (typeof this.hourwake!="undefined"){ //アラームがセットされた時
                    if (this.ctref.title==(this.hourwake+":"+this.minutewake+":"+this.secondwake)){//文字同士を比べる
                        clearInterval(jsalarm.timer)
                        window.location=document.getElementById("musicloc").value//windowで動的にurlに移動
                    }
                }
            },
            init:function(){
                var dateobj=new Date()//現在の時刻取得
                this.ctref=document.getElementById("jsalarm_ct")//現在時刻をいじるためにＩＤをとってくる
                this.submitref=document.getElementById("submitbutton")//セットボタンが押したか押されてないか判断するためにＩＤをとってくる
                this.submitref.onclick=function(){//セットボタンが押された時
                    jsalarm.setalarm()//時間セット
                    this.value="Alarm Set"//ボタンテキストを変更
                    this.disabled=true//セットボタンを無効にすることで何回も押せなくする
                    return false
                }
                this.resetref=document.getElementById("resetbutton")//リセットボタンが押したか押されてないか判断するためにＩＤをとってくる
                this.resetref.onclick=function(){//リセットボタンが押された時
                jsalarm.submitref.disabled=false//セットボタンを再度押せるようにする
                //　　↓　　時刻を再度設定出来るようにする
                jsalarm.hourwake=undefined
                jsalarm.hourselect.disabled=false
                jsalarm.minuteselect.disabled=false
                jsalarm.secondselect.disabled=false
                return false
                }
                this.value="reset";
                var selections=document.getElementsByTagName("select")//時刻の中身を設定するためにＩＤをとってくる
                this.hourselect=selections[0]//時
                this.minuteselect=selections[1]//分
                this.secondselect=selections[2]//秒
                for (var i=0; i<60; i++){
                    if (i<24) //時だけは２４設定
                    this.hourselect[i]=new Option(this.padfield(i), this.padfield(i), false, dateobj.getHours()==i)
                    this.minuteselect[i]=new Option(this.padfield(i), this.padfield(i), false, dateobj.getMinutes()==i)
                    this.secondselect[i]=new Option(this.padfield(i), this.padfield(i), false, dateobj.getSeconds()==i)

                }
                jsalarm.showcurrenttime()//h表示部分
                jsalarm.timer=setInterval(function(){jsalarm.showcurrenttime()}, 1000)//更新し続ける
            },
            setalarm:function(){
                this.hourwake=this.hourselect.options[this.hourselect.selectedIndex].value//選んだ場所の時間を設定時間とする
                this.minutewake=this.minuteselect.options[this.minuteselect.selectedIndex].value//選んだ場所の分を設定時間とする
                this.secondwake=this.secondselect.options[this.secondselect.selectedIndex].value//選んだ場所の秒を設定時間とする
                //選ぶ際は有効にしておく
                this.hourselect.disabled=true
                this.minuteselect.disabled=true
                this.secondselect.disabled=true
            }
        }


        </script>
        </head>
        <body>
        <form action="" method="">
        <div id="jsalarmclock">
            <div class="logo"><b><span>現在時刻:</span><span id="jsalarm_ct" style="letter-spacing: 2px"></span><br>
                <span> 設定時刻 : </span><span><select></select> 時 </span> <span><select></select> 分 </span> <span><select></select> 秒 </span><br>
                <span> Alarm Action↓</span> <input type="text" id="musicloc" size="55" value="https://www.youtube.com/watch?v=ilnLczvLGAY"/> <br><span style="font: normal 20px Tahoma">※　動画など音のするページのURLに書き換えてください　　※</span>
                <input type="submit" value="Set Alarm!" id="submitbutton" /> <input type="reset" value="reset" id="resetbutton" />
                
            <b>
        </div>
        
        </form>

        <script type="text/javascript">
        //起動
        jsalarm.init()

        </script>

        </body>
    </html>
        