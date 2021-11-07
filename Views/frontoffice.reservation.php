<div class="prenota-container">
    <div class="mob-p20">
        <div class="d-flex d-flex-special d-flex-small">
            <svg xmlns="http://www.w3.org/2000/svg" width="39.195" height="38.203" viewBox="0 0 39.195 38.203"
                 class="arrow-back-prenota-cat">
                <path id="Icon_awesome-arrow-left" data-name="Icon awesome-arrow-left"
                      d="M22.527,38.291l-1.942,1.942a2.091,2.091,0,0,1-2.966,0l-17.006-17a2.091,2.091,0,0,1,0-2.966L17.619,3.264a2.091,2.091,0,0,1,2.966,0l1.942,1.942a2.1,2.1,0,0,1-.035,3L11.951,18.249H37.092a2.094,2.094,0,0,1,2.1,2.1v2.8a2.094,2.094,0,0,1-2.1,2.1H11.951L22.492,35.29A2.087,2.087,0,0,1,22.527,38.291Z"
                      transform="translate(0.004 -2.647)" fill="#183a58"></path>
            </svg>
            <div class="plat40 pl0mob">
                <h3 class="title-in-blue-small">Ristoranti</h3>
                <h2 class="title-in-blue" id="placeholder-nome">Il Trabucco</h2>
            </div>
        </div>
        <div class="padded pt100">
            <div class="request-container">
                <div class="mh">
                    <h3 class="title-in-blue-prenota mt60"
                        id="giorno-prenota"><?php echo $langs['quando_vorresti_andare']; ?></h3>
                    <a href="#" class="day-item day-item-real" id="oggi"><?php echo $langs['oggi']; ?></a>
                    <a href="#" class="day-item day-item-real" id="domani"><?php echo $langs['domani']; ?></a>
                    <a href="#" id="open-calendario" name="Calendar" class="day-item">
                        <input type="text" class="datepicker this-dp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M24 2v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2zm6.687 13.482c0-.802-.418-1.429-1.109-1.695.528-.264.836-.807.836-1.503 0-1.346-1.312-2.149-2.581-2.149-1.477 0-2.591.925-2.659 2.763h1.645c-.014-.761.271-1.315 1.025-1.315.449 0 .933.272.933.869 0 .754-.816.862-1.567.797v1.28c1.067 0 1.704.067 1.704.985 0 .724-.548 1.048-1.091 1.048-.822 0-1.159-.614-1.188-1.452h-1.634c-.032 1.892 1.114 2.89 2.842 2.89 1.543 0 2.844-.943 2.844-2.518zm4.313 2.518v-7.718h-1.392c-.173 1.154-.995 1.491-2.171 1.459v1.346h1.852v4.913h1.711z"/>
                        </svg>
                    </a>
                </div>
                <div>
                    <h3 class="title-in-blue-prenota mt60" id="ora-prenota"><?php echo $langs['a_che_ora']; ?></h3>
                    <select class="number-prenota hour-prenota">
                        <option>00</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                    </select>
                    <span class="hour-dots">:</span>
                    <select class="number-prenota minute-prenota">
                        <?php
                        for ($i = 0; $i <= 59; $i++) {
                            ?>
                            <option value="<?php if ($i < 10) echo '0';
                            echo $i; ?>"><?php if ($i < 10) echo '0';
                                echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <h3 class="title-in-blue-prenota mt60"
                        id="quanti-prenota"><?php echo $langs['quanti_siete']; ?></h3>
                    <a href="#" class="day-item item-users">1</a>
                    <a href="#" class="day-item item-users">2</a>
                    <a href="#" class="day-item item-users">3</a>
                    <a href="#" class="day-item item-users">4</a>
                    <a href="#" class="day-item item-users">5</a>
                    <a href="#" class="day-item item-users item-users-plus">+</a>
                </div>
                <input type="submit" class="confirm-prenota" value="CONFERMA">
            </div>
            <div class="confirm-container">
                <?php echo $langs['verificare_disponibilita']; ?>
                <div class="accetto-container">
                    <input type="Checkbox" name="accetto" id="accetto">
                    <label> <?php echo $langs['accetto']; ?></label>
                </div>
                <input type="submit" class="send-prenota" value="<?php echo $langs['invia_richiesta']; ?>">
            </div>
        </div>
    </div>
</div>