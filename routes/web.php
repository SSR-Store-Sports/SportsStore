<?php

require __DIR__ . '/Router.php'; // importação do script de gerenciamento de rotas
use Bramus\Router\Router; // habilitar script para uso no arquivo
$router = new Router(); // instaciando class Router para utilizar seus métodos (Mount, Get, Post, etc...)

// importação global (todas as páginas)
include 'app/views/_components/header/index.php'; // importando o header
include 'app/views/_components/sidebar/index.php'; // importando a sidebar
require 'app/middleware/AdminMiddleware.php';

/*
  ROTAS DE LOGIN E REGISTRO
*/

// método "mount" para adicionar um prefixo nas rotas (agrupamento de rotas)
$router->mount("/auth", function () use ($router) {
  $router->get('/login', function () {
    require 'app/views/users/login/index.php';
  });

  $router->post('/login', function () {
    require 'app/views/users/login/index.php';
  });

  $router->get('/registro', function () {
    require 'app/views/users/register/index.php';
  });

  $router->post('/registro', function () {
    require 'app/views/users/register/index.php';
  });

  $router->get('/logout', function () {
    require 'app/views/users/logout/index.php';
  });

  $router->get('/loading', function () {
    require 'app/views/users/loading/index.php';
  });
  
  $router->get('/forgot-password', function () {
    require 'app/views/users/forgot-password/index.php';
  });

  $router->post('/forgot-password', function () {
    require 'app/views/users/forgot-password/index.php';
  });
});

/*
  ROTAS PRINCIPAIS
*/

$router->get('/', function () {
  require 'app/views/index.php';
});

$router->get('/produtos', function () {
  require 'app/views/products/product/index.php';
});

$router->get('/produto', function () {
  require 'app/views/products/product-selected/index.php';
});

$router->get('/carrinho', function () {
  require 'app/views/products/cart/index.php';
});

$router->get('/historico', function () {
  require 'app/views/products/history/index.php';
});

$router->get('/acompanhamento', function () {
  require 'app/views/products/follow-up/index.php';
});

$router->get('/endereco', function () {
  require 'app/views/users/address/index.php';
});

$router->get('/check', function () {
  require 'app/views/users/check/index.php';
}); 

$router->get('/cuidar-pecas', function () {
  require 'app/views/knowledge_base/care-parts/index.php';
}); 

$router->get('/politica-troca', function () {
  require 'app/views/knowledge_base/exchange-policy/index.php';
}); 

$router->get('/guia-tamanhos', function () {
  require 'app/views/knowledge_base/sizes-guide/index.php';
}); 

$router->get('/termos', function () {
  require 'app/views/terms/index.php';
}); 

$router->get('/privacidade', function () {
  require 'app/views/privacity/index.php';
}); 

/*
  ROTAS DE ADMINISTRAÇÃO
*/
$router->mount("/admin", function () use ($router) {
  $router->get('/', function () {
    require 'app/views/admin/index.php';
  });

  $router->mount("/produtos", function () use ($router) {
    $router->get('/cadastrar', function () {
      require 'app/views/admin/products/index.php';
    });

    $router->post('/cadastrar', function () {
      require 'app/views/admin/products/index.php';
    });

    $router->get('/listar', function () {
      require 'app/views/admin/products/list.php';
    });

    $router->get('/editar', function () {
      require 'app/views/admin/products/edit.php';
    });

    $router->post('/editar', function () {
      require 'app/views/admin/products/edit.php';
    });


  });

  $router->mount("/fornecedores", function () use ($router) {
    $router->get('/cadastrar', function () {
      require 'app/views/admin/supplier/index.php';
    });

    $router->post('/cadastrar', function () {
      require 'app/views/admin/supplier/index.php';
    });

    $router->get('/listar', function () {
      require 'app/views/admin/supplier/list.php';
    });
  });

  $router->mount("/pedidos", function () use ($router) {
    $router->get('/gerenciar', function () {
      require 'app/views/admin/orders/index.php';
    });

    $router->post('/devolucoes', function () {
      require 'app/views/admin/orders/index.php';
    });
  });

  $router->mount("/usuarios", function () use ($router) {
    $router->get('/gerenciar', function () {
      require 'app/views/admin/users/index.php';
    });

    $router->get('/relatorios', function () {
      require 'app/views/admin/users/reports.php';
    });
  });

  $router->mount("/categorias", function () use ($router) {
    $router->get('/cadastrar', function () {
      require 'app/views/admin/categories/index.php';
    });

    $router->post('/cadastrar', function () {
      require 'app/views/admin/categories/index.php';
    });

    $router->get('/listar', function () {
      require 'app/views/admin/categories/list.php';
    });
  });

  $router->mount("/estoque", function () use ($router) {
    $router->get('/cadastrar', function () {
      require 'app/views/admin/stock/index.php';
    });

    $router->post('/cadastrar', function () {
      require 'app/views/admin/stock/index.php';
    });

    $router->get('/listar', function () {
      require 'app/views/admin/stock/list.php';
    });
  });

});

$router->mount("/users", function () use ($router) {
  $router->get('/', function () {
    require 'app/views/users/configuration/index.php';
  });

  $router->post('/', function () {
    require 'app/views/users/configuration/index.php';
  });
});

$router->set404(function () {
  require 'app/views/not-found/index.php';
});

$router->run();

include 'app/views/_components/footer/index.php'; // importando o footer
