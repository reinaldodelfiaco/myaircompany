<?php


function is_guest()
{
    if(!empty(session('id')) && session('id') > 0)
    {
        return false;
    }

    return true;
}

function require_login()
{
	if(is_guest())
	{
		return redirect('usuarios/login');
	}
}


function can_edit_by_id()
{
  return true;
}


function super()
{
	if(session('regra') == 'admin')
	{
		return true;
	}

	return false;
}

function adm()
{
	if(session('regra') == 'admin' || session('regra') == 'super-admin')
	{
		return true;
	}

	return false;
}

function require_super()
{
	if(!super())
	{
		return redirect('usuarios/dashboard');
	}
}

function require_adm()
{
	if(!adm())
	{
		return redirect('usuarios/dashboard');
	}
}