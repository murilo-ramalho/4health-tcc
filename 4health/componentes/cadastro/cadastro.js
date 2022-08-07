import React from 'react';
import { Text, TextInput, View, Button } from 'react-native';

export default function form(){
    return(
        <View>
            <View>
                <Text>preencha o formulario de cadastro:</Text>

                <Text>seu nome:</Text>
                <TextInput placeholder='seu nome'/>

                <Text>número de celular:</Text>
                <TextInput placeholder='(19) -' keyboardType='numeric'/>

                <Text>residencia:</Text>
                <TextInput placeholder='rua e nº'/>

                <Text>seu CPF:</Text>
                <TextInput placeholder='CPF' keyboardType='numeric'/>

                <Text>crie sua senha</Text>
                <TextInput placeholder='sua senha'/>

                <Text>comfirme sua senha</Text>
                <TextInput placeholder='confirmar senha'/>

                <Button title='cadastrar-se'></Button>
            </View>
        </View>
    );
}