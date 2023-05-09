<?php

function auth() {
    $ci =& get_instance();

    if($ci->session->userdata('user')) {
        return $ci->session->userdata('user');
    }

}


function setupSave($data) {
    $ci =& get_instance();
   
    $ci->load->helper('file');

    $data = json_encode($data);

    if (!write_file('application/config/config.env', $data))
    {
        return false;
    }
    
    return true;
}

function setupKey($key, $default='') {
    if(!$config = setupGet()) {
        return false;
    }

    if(isset($config->{$key})) {
        return $config->{$key};
    }

    return $default;
}

function setupGet() {
    if(!file_exists('application/config/config.env')) {
        return false;   
    }

    return json_decode(file_get_contents('application/config/config.env'));
}

function formatBytes($bytes, $precision = 2) {
    $bytes = $bytes * 1024;
    $unit = ["B", "KB", "MB", "GB"];
    $exp = floor(log($bytes, 1024)) | 0;
    return round($bytes / (pow(1024, $exp)), $precision).' '.$unit[$exp];
}

function imageProfile($image, $default='no-photo.jpg') {
    
    $dir = 'public/img/';

    if(!$image) {
        $image = $dir . 'no-photo.jpg';
    }

    $image = $dir . $image;
    
    if(!file_exists($image)) {
        $image = $dir . 'no-photo.jpg';
    }


    return base_url($image);
}

function deleteButton($id, $route) {


    $html = '
        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelId'.$id.'" href="#" role="button">
            <i class="fas fa-trash    "></i>
            Excluir
        </a>

        <!-- Modal -->
        <div class="modal" id="modelId'.$id.'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atenção!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        Deseja excluir esse registro?
                    </div>
                    <form method="POST" action="'.$route.'">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times    "></i> Fechar</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash    "></i> Excluir</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    ';

    return $html;

}