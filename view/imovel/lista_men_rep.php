<?php foreach ($listaMenRep as $list) { ?>
    <fieldset>
        <?php
        $mesAno = explode('/', implode("/", array_reverse(explode("-", $list['men_data']))));
        ?>
        <legend>Mês/Ano Mensalidade e Repasse : <b><?= $mesAno[1] . '/' . $mesAno[2] ?></b></legend>
        <table>
            <thead>
                <tr class="threadBg">
                    <th>Data Mensalidade</th>
                    <th>Valor Mensalidade</th>
                    <th>Status Mensalidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $succesBg = '';
                if ($list['men_status']) {
                    $succesBg = 'successBg';
                }
                ?>
                <tr class="<?= $succesBg ?>">
                    <td class=""><?= implode("/", array_reverse(explode("-", $list['men_data']))) ?></td>
                    <td><?= 'R$ ' . $list['men_valor'] ?></td>
                    <td><?= ($list['men_status'] == false ? "PENDENTE" : "PAGA" ); ?></td>
                    <td>
                        <?php if ($list['men_status'] == false) { ?>
                            <form action="<?= $baseUrl ?>atualizaStatusMensalidade" method="post" >
                                <input type="hidden" value="<?= $list['men_id'] ?>" name="men_id" />
                                <input type="hidden" value="<?= $list['con_id'] ?>" name="con_id" />
                                <input type="submit" value="Info. Pag. Mensalidade" class="cadastro" /> 
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Data Repasse</th>
                    <th>Valor Repasse</th>
                    <th>Status Repasse</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php
            $succesBg = '';
            if ($list['rep_status']) {
                $succesBg = 'successBg';
            }
            ?>
            <tbody>
                <tr class="<?= $succesBg ?>">
                    <td class=""><?= implode("/", array_reverse(explode("-", $list['rep_data']))) ?></td>
                    <td><?= 'R$ ' . $list['rep_valor'] ?></td>
                    <td><?= ($list['rep_status'] == false ? "PENDENTE" : "REALIZADO" ); ?></td>
                    <td>
                        <?php if ($list['rep_status'] == false) { ?>
                            <form action="<?= $baseUrl ?>atualizaStatusRepasse" method="post" >
                                <input type="hidden" value="<?= $list['rep_id'] ?>" name="rep_id" />
                                <input type="hidden" value="<?= $list['con_id'] ?>" name="con_id" />
                                <input type="submit" value="Info. Pag. Repasse" class="cadastro" /> 
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php } ?>