# Simple Classes - Sistema de Aulas Online

## Visão Geral

Simple Classes é um sistema de aulas online desenvolvido para permitir o upload e gerenciamento de vídeos de aulas, interação via chat entre usuários e administradores, e funcionalidades para responder a perguntas relacionadas às aulas. O projeto é projetado para ser uma plataforma simples e intuitiva onde os usuários podem assistir aulas, responder atividades, e se comunicar diretamente com o administrador.

## Funcionalidades

- **Autenticação e Login:**
  - Sistema de login e registro para usuários.
  - Sistema de autenticação para administradores.

- **Gerenciamento de Vídeos:**
  - Administradores podem fazer upload de vídeos, adicionar títulos, descrições e capas.
  - Cada vídeo pode ter perguntas associadas para que os alunos possam responder após assistir.
  - Administradores podem editar e excluir vídeos.

- **Interação via Chat:**
  - Usuários podem se comunicar diretamente com o administrador via chat.
  - O administrador pode gerenciar conversas com todos os usuários registrados.

- **Atividades e Perguntas:**
  - Administradores podem adicionar perguntas para cada vídeo.
  - Usuários podem responder perguntas relacionadas às aulas.
  - Administradores podem ver as respostas enviadas pelos usuários.

## Estrutura do Projeto

O projeto é dividido nas seguintes seções:
- `/pages/`: Contém as páginas do sistema, como login, cadastro, upload de vídeo, chat, etc.
- `/uploads/`: Diretório para armazenamento de vídeos e imagens enviados.
- `/style/`: Arquivos CSS para estilização da interface.
- `/dbphp.php`: Arquivo de conexão com o banco de dados.

## Instalação e Configuração

### Pré-requisitos

- PHP 8.2 ou superior
- Servidor Apache (XAMPP, WAMP, etc.)
- MySQL

### Passos para Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/usuario/simple-classes.git
