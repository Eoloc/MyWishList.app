<?php


namespace wishlist\views;


class ListView extends View
{

    public function views(string $view)
    {
        switch ($view) {
            case 'showAll';
                $this->showAll();
                break;
        }
        switch ($view) {
            case 'showList';
                $this->showList();
                break;
        }
    }

    /**
     * Affiche toutes les listes
     */
    private function showAll()
    {
        echo "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>no</th>
                <th>user_id</th>
                <th>titre</th>
                <th>description</th>
                <th>expiration</th>
                <th>token</th>
            </tr>
            </thead>
            <tbody>\n ";
        foreach ($this->res as $liste) {
            echo "            <tr>\n";
            foreach ($liste as $row) {
                echo "                <td>$row</td>\n";
            }
            echo "            </tr>\n";
        }
        echo "            </tbody>
               </table>
         </div>";
    }

    /**
     * Affiche une liste en particulier en récupérant son token depuis l'URL
     */
    private function showList()
    {
        /**
         * liste
         */
        echo "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>no</th>
                <th>user_id</th>
                <th>titre</th>
                <th>description</th>
                <th>expiration</th>
                <th>token</th>
            </tr>
            </thead>
            <tbody>\n ";
        $liste = $this->res[0];
        echo "            <tr>\n";
        foreach ($liste as $row) {
            echo "                <td>$row</td>\n";
        }
        echo "            </tbody>
               </table>
         </div>";

        /**
         * liste d'item
         */
        $items = $this->res[1];
        echo "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th scope=\"col\">id</th>
                <th scope=\"col\">liste id</th>
                <th scope=\"col\">nom</th>
                <th scope=\"col\">description</th>
                <th scope=\"col\">image</th>
                <th scope=\"col\">url</th>
                <th scope=\"col\">tarif</th>
            </tr>
            </thead>
            <tbody> ";
        foreach ($items as $item){
            echo "<tr>";
            $i = 0;
            foreach ($item as $row){
                if($i == 4){
                    echo "<td><img src=\"src\img\\" . $row . "\" height=\"50\"/></td>";
                }
                else{
                    echo "<td>$row</td>";
                }
                $i += 1;
            }
            echo "</tr>";
        }
        echo "</tbody>
        </table>
    </div>";

    }

}