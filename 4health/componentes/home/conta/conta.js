import React from 'react';
import { View, Text, Image} from 'react-native';

export default function conta(){
    return(
        <View>
            <Image source={require('./icone.png')} style={{ width: 30, height: 30 }} />
            <Text>bem vindo</Text>
            
            <Image source={require('./sair.png')} style={{width: 20, height: 20}} />
        </View>
    );
}