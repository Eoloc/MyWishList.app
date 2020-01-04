<?php


namespace wishlist\views;


class ListView extends View
{

    public function views(string $view)
    {
        switch ($view){
            case 'showAll';
            $this->showAll();
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
        foreach ($this->res as $liste){
            echo "            <tr>\n";
            foreach ($liste as $row){
                echo "                <td>$row</td>\n";
            }
            echo "            </tr>\n";
        }
        echo "            </tbody>
        </table>
    </div>";
    }
}