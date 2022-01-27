/**
 * ロード時にメッセージ一覧の取得
 */
$(function() {
    get_chat_messages();
});

/**
 * @type {number} 現在のメッセージ数 初期値
 */
let current_messages_num = 0;
/**
 * @type {string[]} URLパスを/区切りで配列にする
 */
const path = location.pathname.split('/');
/**
 * @type {string} チャットルームID
 */
const room_id = path[3];

/**
 * メッセージ取得関数
 *
 * チャットルームのメッセージを取得する
 * setTimeoutで5秒ごとにメッセージ一覧数を確認する
 * メッセージ一覧数が変更されていたら、メッセージ一覧を新しく表示する
 */
function get_chat_messages() {
    $.ajax({
        url: `ajax/${room_id}`,
        dataType: "json",
        success: data => {
            if (current_messages_num !== data.messages.length) {
                $("#message_wrap").find(".message_text").remove();
                for (let i = 0; i < data.messages.length; i++) {
                    current_messages_num = data.messages.length;
                    if (data.messages[i].student_user === 0) {
                        let message_html = `<div class="message_text text-right ">
                                                <div class="balloon1-right">
                                                    <p>${data.messages[i].message}</p>
                                                </div>
                                            </div>`;
                        $("#message_wrap").append(message_html);
                    } else {
                        let message_html = `<div class="message_text">
                                                <div class="balloon1-left">
                                                    <p>${data.messages[i].message}</p>
                                                </div>
                                             </div>`;
                        $("#message_wrap").append(message_html);
                    }
                }
                $('html').animate({scrollTop: $('.chat_input').offset().top},'slow');
            }
        },
        error: () => {
            alert("メッセージが取得できません。");
        }
    });

    setTimeout(get_chat_messages, 5000);
}
